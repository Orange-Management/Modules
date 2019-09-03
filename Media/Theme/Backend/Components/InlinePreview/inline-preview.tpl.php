<div class="ipt-wrap">
    <div class="ipt-first">
        <div class="advancedInput wf-100" id="iMediaInput">
            <input autocomplete="off" class="input" id="mediaInput" name="<?= $this->name; ?>-search" type="text" data-emptyAfter="true" data-autocomplete="false" data-src="api/media/find?search={#mediaInput}">
            <div id="iMediaInput-dropdown" class="dropdown" data-active="true">
                <table id="iMediaInput-table" class="default">
                    <thead>
                        <tr>
                            <td>ID<i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                            <td>Name<i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                            <td>Extension<i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                    <tbody>
                        <template id="iMediaInput-rowElement" class="rowTemplate">
                            <tr tabindex="-1">
                                <td data-tpl-text="/id" data-tpl-value="/id" data-value=""></td>
                                <td data-tpl-text="/name" data-tpl-value="/name" data-value=""></td>
                                <td data-tpl-text="/extension"></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="ipt-second"><button><?= $this->getHtml('Select', 'Media') ?></button></div>
</div>
<tr><td>
        <input type="hidden" name="<?= $this->name; ?>-path" form="<?= $this->form; ?>" value="<?= $this->virtualPath; ?>">
        <input type="file" id="i<?= $this->form; ?>-upload" class="preview" name="<?= $this->name; ?>" form="<?= $this->form; ?>" multiple>
        <input form="<?= $this->form; ?>" type="hidden" name="media-list">