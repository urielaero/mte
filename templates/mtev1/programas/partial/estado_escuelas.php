<h2 class="title green">Clave CCT de las escuelas en las que se trabaja(2013/2014)</h2>
        <div class="white-box map">
            <table>
                <?php foreach($this->escuelas as $escuela){ ?>
                <tr>
                    <td>CCT <?= $escuela->cct ?> | <?= $escuela->nombre ?></td>
                    <td><a href="/escuelas/index/<?= $escuela->cct ?>" class="button-frame"><span class="button">Ver escuela</span></a></td>
                    <div class="clear"></div>
                </tr>
                <?php }?>
</table>
</div>