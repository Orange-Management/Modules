<section class="box w-100">
        <div class="inner">
            <input type="text" name="title" placeholder="&#xf040; This is a news title" form="newsForm">
        </div>
    </section>

    <section class="box w-100">
        <div class="inner">
            <i class="fa fa-header"></i>
            <i class="fa fa-link"></i>
            <i class="fa fa-image"></i>
            <i class="fa fa-bold"></i>
            <i class="fa fa-italic"></i>
            <i class="fa fa-underline"></i>
            <i class="fa fa-strikethrough"></i>
            <i class="fa fa-list-ol"></i>
            <i class="fa fa-list-ul"></i>
            <i class="fa fa-quote-right"></i>
            <i class="fa fa-subscript"></i>
            <i class="fa fa-superscript"></i>
            <i class="fa fa-question-circle floatRight"></i>
        </div>
    </section>

    <div class="box w-100">
        <div class="tabular">
            <ul class="tab-links">
                <li><label for="c-tab-1"><?= $this->getText('Plain') ?></label>
                <li><label for="c-tab-2"><?= $this->getText('Preview') ?></label>
            </ul>
            <div class="tab-content">
                <input type="radio" id="c-tab-1" name="tabular-1" checked>

                <div class="tab">
                    <textarea style="height: 300px" placeholder="&#xf040;" name="plain" form="newsForm"></textarea><input type="hidden" id="iParsed" name="parsed">
                </div>
                <input type="radio" id="c-tab-2" name="tabular-1">

                <div class="tab">
                </div>
            </div>
        </div>
    </div>