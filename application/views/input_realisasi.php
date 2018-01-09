<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>No.</th>
        <th>Tanggal</th>
        <th>Nilai Kontrak</th>
        <th>Realisasi</th>
        <th>Sisa Kontrak</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td></td>
        <td></td>
        <td style="text-align: right"><?php echo number_format($proyek->nilai_kontrak, 2, ',', '.'); ?></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <?php $i = 1; $sisa_kontrak = $proyek->nilai_kontrak; $total = 0; foreach($data as $d) { ?>        
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $d->tgl; ?></td>
            <td>&nbsp;</td>
            <td style="text-align: right"><?php echo number_format($d->jumlah, 2, ',', '.'); ?></td>
            <td>&nbsp;</td>
            <td><a data-toggle="tooltip" class="delete_realisasi" data-placement="top" title="Hapus realisasi" data-id="<?php echo $d->id; ?>"><img src="<?php echo base_url() . 'images/cross.png'; ?>"/></a></td>
        </tr>
    <?php $i++; $sisa_kontrak = $sisa_kontrak - $d->jumlah; $total = $total + $d->jumlah; } ?>
            <tr>
                <td style="text-align: center" colspan="2">Jumlah</td>
                <td style="text-align: right"><?php echo number_format($proyek->nilai_kontrak, 2, ',', '.'); ?></td>
                <td style="text-align: right"><?php echo number_format($total, 2, ',', '.'); ?></td>
                <td style="text-align: right"><?php echo number_format($sisa_kontrak, 2, ',', '.'); ?></td>
                <td></td>
            </tr>
    </tbody>
</table>

<script>
    $('.delete_realisasi').on('click', function() {
        if(confirm('Hapus realisasi?')) {
            var id = $(this).attr('data-id'); 
            
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/proyek/hapus_realisasi/' + id + '/' + <?php echo $id; ?>,
                method: 'GET'
            }).success(function(response) {                  
                $('#tabel_realisasi').html(response);               
            });
        }

    });
</script>
