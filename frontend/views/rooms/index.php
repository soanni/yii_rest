<div class="row">
    <?php foreach($data->getModels() as $model):?>
        <div class="col-lg-3" style="border:1px solid gray; margin-right: 10px; padding: 20px">
            <h2>Room #<?= $model->id;?></h2>
            Floor: <?= $model->floor;?>
            <br/>
            Number:<?= $model->room_number;?>
        </div>
    <?php endforeach;?>
</div>