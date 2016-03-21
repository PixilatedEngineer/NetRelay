#!/usr/bin/python2.7

import shutil
import os
import sys
import time
import datetime
import zipfile
import xml.etree.ElementTree as ET

#-----------------------------------------------------------------------------------------------------
#	config
ZIP_PATH_FILE = 'Config.zip'		# path to Config.zip, for example /var/www/html/Config.zip
ZIP_NO_BACKUP = False			# setting to True - no Config.zip backup would be created
LOG_NO_DEBUG = False			# setting to True - script would be running in *silent* mode
#-----------------------------------------------------------------------------------------------------

def debugLog(msg):
	if LOG_NO_DEBUG is False:
		print '['+str(datetime.datetime.utcnow())+']['+sys.argv[0]+'][debug] '+msg

def getNewRuleName(host, state, relay):
	return 'Relay-' + host + '-' + state + '-' + str(relay)

def getNewChildRule(ruleName, ruleID, ruleHost):
	# create new element
	child = ET.Element('NetRule')
	# add subElements to it according to structure
	childName = ET.SubElement(child, 'name')
	childID = ET.SubElement(child, 'id')
	childIsModified = ET.SubElement(child, 'isModified')
	childControlInfo = ET.SubElement(child, 'ControlInfo')
	childMode = ET.SubElement(childControlInfo, 'mode')
	childProtocol = ET.SubElement(childControlInfo, 'protocol')
	childHost = ET.SubElement(childControlInfo, 'host')
	childPort = ET.SubElement(childControlInfo, 'port')
	childTimeout = ET.SubElement(childControlInfo, 'timeout')
	childMethod = ET.SubElement(childControlInfo, 'method')
	childEncodeURLs = ET.SubElement(childControlInfo, 'encodeURLs')
	# set values for each subElement
	childName.text = ruleName
	childID.text = str(ruleID)
	childIsModified.text = 'false'
	childMode.text = 'URl-Encoded'
	childProtocol.text = 'htpp'
	childHost.text = ruleHost
	childPort.text = '80'
	childTimeout.text = '500'
	childMethod.text = 'GET'
	childEncodeURLs.text = 'false'
	# return created new net rule back
	return child

def getResFileContent(ipRelay, ipController, state, relay):
	resTemplate = ('GET /relaycontrol.php?ip='+str(ipRelay)+'&state='+str(state)+'&relay='+str(relay)+' HTTP/1.1\n'
				'Host: '+str(ipController)+':80\n'
				'User-Agent: Mozilla/4.0\n'
				'Connection: Close\n'
				'Content-Type: application/x-www-form-urlencoded\n\n'
				)
	return resTemplate

def createResFile(folder, fileRuleID, ipRelay, ipController, state, relay):
	#filePathName = folder + '/CONF/NET/' + str(fileRuleID) + '.RES'
	filePathName = os.path.join(folder, 'CONF', 'NET', (str(fileRuleID) + '.RES'))
	with open(filePathName,'a+') as f:
		f.write(getResFileContent(ipRelay, ipController, state, relay))
		debugLog('\tfile created: ' + filePathName)

#-----------------------------------------------------------------------------------------------------
#	main
#-----------------------------------------------------------------------------------------------------

# need to be sure both IPs for relay and cotroller are provided
if (len(sys.argv) == 3):
	ipRelay = sys.argv[1]
	ipController = sys.argv[2]
	debugLog('provided position parameters: ipRelay='+ipRelay+' ipController'+ipController)
else:
	debugLog('incorrect usage. example: '+sys.argv[0]+' $ipRelay $ipController')
	sys.exit(1)
# need to be sure zip file contains configs exists
if os.path.exists(ZIP_PATH_FILE) is False:
	debugLog('configured zip config file does not exists: '+ZIP_PATH_FILE)
	sys.exit(1)

currentExecutionTimestamp = datetime.datetime.fromtimestamp(time.time()).strftime('%Y_%m_%d_%H_%M_%S')
# zip config backup could be skipped by config option
if ZIP_NO_BACKUP is False:
	currentExecutionBackup = 'Config_backup_' + currentExecutionTimestamp + '.zip'
	shutil.copyfile(ZIP_PATH_FILE, currentExecutionBackup)
	debugLog('backup file is created: '+ currentExecutionBackup)
else:
	debugLog('no backup would be created, skipped by config option')

# extracting zip config content into temporary directory
# building tree xml structure for present elements in RES.CFG
zfile = zipfile.ZipFile(ZIP_PATH_FILE)
temporaryExtractFolder = os.path.join(os.getcwd(), ('temp_'+currentExecutionTimestamp))
zfile.extractall(temporaryExtractFolder)
debugLog('zip content is extracted to temporary directory: ' + temporaryExtractFolder)
resFile = os.path.join(temporaryExtractFolder, 'CONF', 'NET', 'RES.CFG')
tree = ET.parse(resFile)
root = tree.getroot()

# we are going into loop to find max present rule ID
maxRuleID = 1
for nextAvailableRule in root.findall('NetRule'):
	ruleID = int(nextAvailableRule.find('id').text)
	maxRuleID = ruleID if (maxRuleID < ruleID) else maxRuleID

# we are going into loop to append new elements to a root
for relay in range(1, 17): # equals [1;17) interval
	for state in ['on', 'off']:
		# for each possible relay<->state combination - create a rule for RES.CFG and create its RES file
		maxRuleID += 1
		newRule = getNewChildRule(getNewRuleName(ipController, state, relay), maxRuleID, ipController)
		root.append(newRule)
		createResFile(temporaryExtractFolder, maxRuleID, ipRelay, ipController, state, relay)
		debugLog('\tnew net rule is added to xml structured config tree: [ID='+str(maxRuleID)+']')

# commit tree changes to RES.CFG file
tree.write(resFile)
debugLog('new created xml tree is committed to RES.CFG: '+resFile)

# make zip of prepared folder content and get rid of temp folder
os.remove(ZIP_PATH_FILE)
shutil.make_archive(ZIP_PATH_FILE.replace('.zip', ''), format='zip', root_dir=temporaryExtractFolder)
shutil.rmtree(temporaryExtractFolder)
debugLog('new updated zip archive created: '+ZIP_PATH_FILE)
debugLog('temporary directory deleted '+temporaryExtractFolder)
