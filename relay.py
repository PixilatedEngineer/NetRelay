import socket
import sys

import optparse

parser = optparse.OptionParser("usage: %prog [options]")

parser.add_option("-i", "--ip", help="IP Address")
parser.add_option("-s", "--state", help="on/off")
parser.add_option("-r", "--relay", help="Relay Number, 1-16")

(options, args) = parser.parse_args()

if options.state == 'on':
	state = 1
if options.state == 'off':
	state = 2

init_cmd =   [0xaa, 0x1e,   1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0xbb]
switch_cmd = [0xaa,  0xf, int(options.relay) - 1, state, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0xbb]

# Create a TCP/IP socket
sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

# Connect the socket to the port where the server is listening
server_address = (options.ip, 8080)
print >>sys.stderr, 'connecting to %s port %s' % server_address
sock.connect(server_address)

try:
    
    # Send data
    cmd_bin = ''.join(map(chr, init_cmd))
    print >>sys.stderr, 'sending "%s"' % ':'.join(x.encode('hex') for x in cmd_bin)
    sock.sendall(cmd_bin)

    # Look for the response
    amount_received = 0
    amount_expected = 20
    
    while amount_received < amount_expected:
        data = sock.recv(20)
        amount_received += len(data)
        print >>sys.stderr, 'received "%s"' % ':'.join(x.encode('hex') for x in data)

    # Send data
    switch_bin = ''.join(map(chr, switch_cmd))
    print >>sys.stderr, 'sending "%s"' % ':'.join(x.encode('hex') for x in switch_bin)
    sock.sendall(switch_bin)

    amount_received = 0
    amount_expected = 20

    while amount_received < amount_expected:
        data = sock.recv(20)
        amount_received += len(data)
        print >>sys.stderr, 'received "%s"' % ':'.join(x.encode('hex') for x in data)


finally:
    print >>sys.stderr, 'closing socket'
    sock.close()


