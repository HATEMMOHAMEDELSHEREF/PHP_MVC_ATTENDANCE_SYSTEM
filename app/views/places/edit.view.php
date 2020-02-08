<?php
extract($this->Data);
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">

            <?php
            if (isset($_SESSION['place'])){
                echo '<div class="alert alert-'.$_SESSION['place']['Type'].' '.$_SESSION['place']['Type'].'-operation" style="visibility: hidden" id="MESSAGE">
                '.$_SESSION['place']['Msg'].'
                </div>';
                unset($_SESSION['place']);
            }
            ?>
            <div class="track-panel">
                <h3>Edit Place</h3>
            </div>
        </div>
        <div class="col-xs-12 trackss">
            <div class="col-xs-12 add-track">
                <form autocomplete="off" novalidate action="/places/edit/<?=$place[0]->place_id;?>" method="post">
                    <div class="col-xs-6 tracks-left-side">
                        <div class="form-group">
                            <label><span class="text-dark">Place Name</span></label>
                            <input type="text" class="form-control" name="place_name"  placeholder="Track Name" value="<?=$place[0]->place_name;?>">
                            <input type="hidden" class="form-control" name="place_id" placeholder="place Id" value="<?=$place[0]->place_id;?>">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary form-control save-add-track">Save</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
