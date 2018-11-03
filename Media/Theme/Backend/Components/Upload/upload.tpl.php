<section class="box wf-100">
    <header><h1><?= $this->getHtml('Media') ?></h1></header>

    <div class="inner">
        <form id="<?= $this->form; ?>-upload">
            <table class="layout wf-100">
                <tbody>
                <tr><td><label for="iMedia"><?= $this->getHtml('Media') ?></label>
                <tr><td>
                    <div class="ipt-wrap">
                        <div class="ipt-first"><input type="text" id="iMedia" name="mediaFile" placeholder="&#xf15b; File"></div>
                        <div class="ipt-second"><button><?= $this->getHtml('Select', 'Media') ?></button></div>
                    </div>
                <tr><td><label for="iUpload"><?= $this->getHtml('Upload', 'Media') ?></label>
                <tr><td>
                    <input type="file" id="iUpload" name="upload" form="<?= $this->form; ?>" multiple>
                    <input form="<?= $this->form; ?>" type="hidden" name="media-list"><td>
            </table>
        </form>
    </div>
</section>