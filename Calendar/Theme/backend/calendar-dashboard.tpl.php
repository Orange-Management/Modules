<section class="wf-75 floatLeft">
    <section class="box w-100">
        <ul class="btns floatLeft">
            <li><a href=""><i class="fa fa-arrow-left"></i></a>
            <li><a href=""><i class="fa fa-arrow-right"></i></a>
        </ul>
        <ul class="btns floatRight">
            <li><a href=""><?= $this->l11n->lang['Calendar']['Day'] ?></a>
            <li><a href=""><?= $this->l11n->lang['Calendar']['Week'] ?></a>
            <li><a href=""><?= $this->l11n->lang['Calendar']['Month'] ?></a>
            <li><a href=""><?= $this->l11n->lang['Calendar']['Year'] ?></a>
        </ul>
    </section>
    <section class="box w-100">
        <div class="m-calendar-month">
            <?php for($i = 0; $i < 6; $i++) : ?>
            <div class="wf-100">
                <?php for($j = 0; $j < 7; $j++) : ?><div style="display: inline-block; box-sizing: border-box; width: 14.28%; height: 100px; border: 1px solid #000; margin: 0; padding: 3px;"><?= $this->l11n->lang[0][jddayofweek($j, 1)]; ?></div><?php endfor; ?>
            </div>
            <?php endfor;?>
        </div>
    </section>
</section>

<section class="wf-25 floatLeft">
    <section class="box w-100">
        <h1>Title</h1>

        <div class="inner">
            <form>
                <table class="layout wf-100">
                    <tr>
                        <td><label>Layout</label>
                    <tr>
                        <td><select>
                                <option>
                            </select>
                </table>
            </form>
        </div>
    </section>

    <section class="box w-100">
        <h1>Calendars</h1>

        <div class="inner">
            <ul class="boxed">
                <li><i class="fa fa-times warning"></i> <span class="check"><input type="checkbox" id="iDefault" checked><label for="iDefault">Default</label></span>
            </ul>
            <div class="spacer"></div>
            <button><i class="fa fa-calendar-plus-o"></i> <?= $this->l11n->lang[0]['Add'] ?></button> <button><i class="fa fa-calendar-check-o"></i> <?= $this->l11n->lang[0]['Create'] ?></button>
        </div>
    </section>
</section>
