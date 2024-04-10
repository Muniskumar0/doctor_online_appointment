<?php
include ('admin/db_connect.php');
?>
<style>
    #uni_modal .modal-footer{
        display: none;
    }
</style>
<div class="container-fluid">
    <div class="col-lg-12">
        <div id="msg"></div>
        <form action="" id="manage-appointment">
            <input type="hidden" name="doctor_id" value="<?php echo $_GET['id'] ?>">
            <div class="form-group">
                <label for="" class="control-label">Date</label>
                <input type="date" value="<?= date('Y-m-d') ?>" name="date" class="form-control" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>" required>
            </div>

            <div class="form-group">
                <label for="" class="control-label">Time</label>
                <select class="form-control" name="time" id="time-select" required>
                    <?php
                    $start = strtotime("10:00 AM");
                    $end = strtotime("07:00 PM");
                    $interval = 20 * 60; // 20 minutes * 60 seconds
                    for ($i = $start; $i <= $end; $i += $interval) {
                        $time_slot = date("h:i A", $i);
                        echo "<option value='$time_slot'>$time_slot</option>";
                    }
                    ?>
                </select>
            </div>

            <hr>
            <div class="col-md-12 text-center">
                <button class="btn-primary btn btn-sm col-md-4">Request</button>
                <button class="btn btn-secondary btn-sm col-md-4" type="button" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>

<script>
    $("#manage-appointment").submit(function(e){
        e.preventDefault();
        start_load();
        $.ajax({
            url:'admin/ajax.php?action=set_appointment',
            method:'POST',
            data:$(this).serialize(),
            success:function(resp){
                resp = JSON.parse(resp);
                if(resp.status == 1){
                    alert_toast("Request submitted successfully");
                    end_load();
                    $('.modal').modal("hide");
                }else{
                    $('#msg').html('<div class="alert alert-danger">'+resp.msg+'</div>');
                    end_load();
                }
            }
        });
    });
</script>
