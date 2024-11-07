<form class="form" method="post" action="<?= base_url('client/order/save') ?>">
    <div class="modal-body">
        <div class="form-group">
            <label for="user_id">Layanan</label>
            <select class="form-control" name="service" id="user_id" required>
                <?php foreach ($services as $service): ?>
                    <option value="<?= $service['id'] ?>"><?= $service['nama'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Simpan
        </button>
    </div>
</form>
