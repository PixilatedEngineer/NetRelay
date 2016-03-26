<?php if(isset($board)): ?>
    <h4>Edit: <?php echo $board['name'] . ' #'.$board['id'];?></h4>
    <hr/>
<?php endif; ?>
<form method="post" action="<?php echo $action;?>">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="ip-address">IP Address</label>
                <input required type="text" class="form-control" name="ip-address" id="ip-address" placeholder="IP Address" value="<?php if(isset($board)) echo $board['ip'];?>">
            </div>
            <div class="form-group">
                <label for="board-name">Board Name</label>
                <input type="text" class="form-control" name="board-name" id="board-name" placeholder="Board Name" value="<?php if(isset($board)) echo $board['name'];?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="board-location">Board Location</label>
                <input type="text" class="form-control" name="board-location" id="board-location" placeholder="Board Location" value="<?php if(isset($board)) echo $board['location'];?>">
            </div>
            <div class="form-group">
                <label for="relays-number">Number of relays</label>
                <select <?php if($current_page == 'edit_board') echo 'disabled';?> required class="form-control" name="relays-number" id="relays-number">
                    <option value="4" <?php if(isset($relays_count) && $relays_count == 4) echo 'selected';?>>4</option>
                    <option value="8" <?php if(isset($relays_count) && $relays_count == 8) echo 'selected';?>>8</option>
                    <option value="16" <?php if(isset($relays_count) && $relays_count == 16) echo 'selected';?>>16</option>
                    <option value="32" <?php if(isset($relays_count) && $relays_count == 32) echo 'selected';?>>32</option>
                </select>
            </div>
        </div>
    </div>

    <hr/>
    <h4 class="relays-edit-title">Relays</h4>
    <hr/>

    <div class="relays-edit-group">
        <div class="row">
            <?php for($i = 1; $i <= $cols; $i++): ?>
                <div class="col-sm-6 col-md-3">
                    <?php for($j = 1; $j <= $rows; $j++, $number++): ?>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-xs-2 col-sm-2 col-md-2"
                                       for="relay-name-<?php echo isset($relays) ? $relays[$number]['relay_id'] : $number;?>">
                                    #<?php echo isset($relays) ? $relays[$number]['relay_id'] : $number;?>
                                </label>
                                <div class="col-xs-10 col-sm-10 col-md-10">
                                    <input required type="text" class="form-control"
                                           name="relays[<?php echo isset($relays) ? $relays[$number]['relay_id'] : $number;?>]"
                                           id="relay-name-<?php echo isset($relays) ? $relays[$number]['relay_id'] : $number;?>"
                                           placeholder="Relay Name"
                                           value="<?php if(isset($relays)) echo $relays[$number]['name'];?>">
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <hr/>

    <div class="row">
        <div class="col-md-12">
            <input class="btn btn-primary" type="submit" value="<?php echo $submit_value;?>"/>
            <?php if(isset($board)): ?>
                <a class="btn btn-danger" id="board-delete-button" href="/boards/delete/<?php echo $board['id'];?>">Delete</a>
            <?php endif; ?>
        </div>
    </div>

</form>