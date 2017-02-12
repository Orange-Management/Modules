<?php include __DIR__ . '/Worker.php'; ?>

<!--suppress ALL -->
<div class="areamanager-report">
    <!-- Client rating -->
    <div id="areamanager-report-select">
        <header></header>

        <div>
            <form method="post"
                  action="<?= \phpOMS\Uri\UriFactory::build('{/scheme}://{/host}/{/root}/{/lang}/api/reporter/single.php?{?}&id=' . $this->request->getData('id')); ?>">
                <ul>
                    <li class="rf"><?= $now->format('Y-m-d'); ?>
                    <li><label for="i-areamanager"><?= $lang['AreaManager']; ?></label>: <select name="i-areamanager"
                                                                                                 id="i-areamanager">
                            <option value="-1" selected disabled><?= $lang['Select']; ?>
                                <?php foreach ($areas as $area): ?>
                            <option value="<?= $area; ?>"<?= $area === $source ? ' selected' : ''; ?>><?= $area; ?>
                                <?php endforeach; ?>
                        </select>
                </ul>
            </form>
        </div>
    </div>

    <!-- Client rating -->
    <table id="areamanager-report-rating">
        <thead>
        <tr>
            <th colspan="4"><?= $lang['ClientRating']; ?>
        <tbody>
        <tr>
            <th><?= $lang['Rating']; ?>
            <th><?= $now2->format('Y'); ?>
            <th><?= $now1->format('Y'); ?>
            <th><?= $now->format('Y'); ?>
        <tr>
            <th>A: (&#8364; > <?= number_format(5000, 0, '.', ','); ?>)
            <td><?= number_format($rating['vvj']['A'], 0, '.', ','); ?>
            <td><?= number_format($rating['vj']['A'], 0, '.', ','); ?>
            <td><?= number_format($rating['aj']['A'], 0, '.', ','); ?>
        <tr>
            <th>B: (<?= number_format(2500, 0, '.', ','); ?> < &#8364; &#8804; <?= number_format(5000, 0, '.', ','); ?>)
            <td><?= number_format($rating['vvj']['B'], 0, '.', ','); ?>
            <td><?= number_format($rating['vj']['B'], 0, '.', ','); ?>
            <td><?= number_format($rating['aj']['B'], 0, '.', ','); ?>
        <tr>
            <th>C: (<?= number_format(250, 0, '.', ','); ?> < &#8364; &#8804; <?= number_format(2500, 0, '.', ','); ?>)
            <td><?= number_format($rating['vvj']['C'], 0, '.', ','); ?>
            <td><?= number_format($rating['vj']['C'], 0, '.', ','); ?>
            <td><?= number_format($rating['aj']['C'], 0, '.', ','); ?>
        <tr>
            <th>D: (<?= number_format(1, 0, '.', ','); ?> < &#8364; &#8804; <?= number_format(250, 0, '.', ','); ?>)
            <td><?= number_format($rating['vvj']['D'], 0, '.', ','); ?>
            <td><?= number_format($rating['vj']['D'], 0, '.', ','); ?>
            <td><?= number_format($rating['aj']['D'], 0, '.', ','); ?>
        <tr>
            <th>E: (&#8364; &#8804; <?= number_format(1, 0, '.', ','); ?>)
            <td><?= number_format($rating['vvj']['E'], 0, '.', ','); ?>
            <td><?= number_format($rating['vj']['E'], 0, '.', ','); ?>
            <td><?= number_format($rating['aj']['E'], 0, '.', ','); ?>
    </table>

    <!-- Client new/lost -->
    <table id="areamanager-report-clientmovement">
        <thead>
        <tr>
            <th colspan="3"><?= $lang['ClientMovement']; ?>
        <tbody>
        <tr>
            <th><?= $lang['Type']; ?>
            <th><?= $lang['Value']; ?>
            <th><?= $lang['Turnover']; ?>
        <tr>
            <th><?= $lang['NewClients']; ?>
            <td><?= $movement['new']['value']; ?>
            <td><?= number_format($movement['new']['sales'], 0, '.', ','); ?>
        <tr>
            <th><?= $lang['LostClients']; ?>
            <td><?= $movement['lost']['value']; ?>
            <td><?= number_format($movement['lost']['sales'], 0, '.', ','); ?>
        <tr>
            <th><?= $lang['NotVisited']; ?>
            <td><?= $movement['notvisited']['value']; ?>
            <td><?= number_format($movement['notvisited']['sales'], 0, '.', ','); ?>
        <tr>
            <th><?= $lang['Visited']; ?>
            <td><?= $movement['visited']['value']; ?>
            <td><?= number_format($movement['visited']['sales'], 0, '.', ','); ?>
        <tr>
            <th><?= $lang['VisitedLost']; ?>
            <td><?= $movement['visitedlost']['value']; ?>
            <td><?= number_format($movement['visitedlost']['sales'], 0, '.', ','); ?>
    </table>

    <!-- Turnover -->
    <div class="areamanger-box full">
        <header></header>

        <div class="reporter-scroll-wrapper">
            <table id="areamanager-report-turnoveroverview">
                <tbody>
                <tr>
                    <th><?= $lang['Type']; ?>
                    <th><?= $now2m->format('m'); ?>
                    <th><?= $now11m->format('m'); ?>
                    <th><?= $now1->format('Y m'); ?>
                    <th><?= $now->format('m'); ?>
                    <th><?= $lang['Diff']; ?>
                    <th><?= $lang['DiffP']; ?>
                    <th><?= $now2->format('Y') . ' ' . $now2->format('m'); ?>
                    <th><?= $now1->format('Y') . ' ' . $now1->format('m'); ?>
                    <th><?= $now->format('Y') . ' ' . $now->format('m'); ?>
                    <th><?= $lang['Diff']; ?>
                    <th><?= $lang['DiffP']; ?>
                    <th><?= $now2->format('Y'); ?>
                    <th><?= $now1->format('Y'); ?>
                    <th><?= $now->format('Y'); ?>
                    <th><?= $lang['Trend']; ?>
                <tr class="reporter-subheadline">
                    <th><?= $lang['Total']; ?>
                    <th><?php $sum = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum += $sales[$id][$nowm2ml];
                            }
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum += $sales[$id][$nowm1ml];
                            }
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum1 = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum1 += $sales[$id][(int) $now->format('m') + 12];
                            }
                        }
                        echo number_format($sum1, 2, ',', '.'); ?>
                    <th><?php $sum2 = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum2 += $sales[$id][(int) $now->format('m') + 24];
                            }
                        }
                        echo number_format($sum2, 2, ',', '.'); ?>
                        <?php $diff = ($sum1 === 0.0 ? 0.0 : 100 * ($sum2 - $sum1) / abs($sum1)); ?>
                    <th><?= number_format($sum2 - $sum1, 2, ',', '.'); ?>
                    <th><?= number_format($diff, 2, ',', '.'); ?>%
                    <th><?php $sum = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum += $sales['accumulated'][$id][1];
                            }
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum1 = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum1 += $sales['accumulated'][$id][2];
                            }
                        }
                        echo number_format($sum1, 2, ',', '.'); ?>
                    <th><?php $sum2 = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum2 += $sales['accumulated'][$id][3];
                            }
                        }
                        echo number_format($sum2, 2, ',', '.'); ?>
                        <?php $diff = ($sum1 === 0.0 ? 0.0 : 100 * ($sum2 - $sum1) / abs($sum1)); ?>
                    <th><?= number_format($sum2 - $sum1, 2, ',', '.'); ?>
                    <th><?= number_format($diff, 2, ',', '.'); ?>%
                    <th><?php $sum = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum += $sales['accumulated'][$id][4];
                            }
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum += $sales['accumulated'][$id][5];
                            }
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum = 0.0;
                        foreach($types as $ids) {
                            foreach($ids['elements'] as $id) {
                                $sum += $sales['accumulated'][$id][6];
                            }
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><i class="fa fa-arrow-circle-o-right"
                           style="transform: rotate(<?= (int) rotatingTrend((int) $diff) ?>deg)"></i>
                        <?php foreach ($types as $ids) : ?>
                <tr class="reporter-subheadline">
                    <th><i class="fa fa-tag"></i> <?= $lang[$ids['title']]; ?>
                    <th><?php $sum = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum += $sales[$id][$nowm2ml];
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum += $sales[$id][$nowm1ml];
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum1 = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum1 += $sales[$id][(int) $now->format('m') + 12];
                        }
                        echo number_format($sum1, 2, ',', '.'); ?>
                    <th><?php $sum2 = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum2 += $sales[$id][(int) $now->format('m') + 24];
                        }
                        echo number_format($sum2, 2, ',', '.'); ?>
                        <?php $diff = ($sum1 === 0.0 ? 0.0 : 100 * ($sum2 - $sum1) / abs($sum1)); ?>
                    <th><?= number_format($sum2 - $sum1, 2, ',', '.'); ?>
                    <th><?= number_format($diff, 2, ',', '.'); ?>%
                    <th><?php $sum = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum += $sales['accumulated'][$id][1];
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum1 = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum1 += $sales['accumulated'][$id][2];
                        }
                        echo number_format($sum1, 2, ',', '.'); ?>
                    <th><?php $sum2 = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum2 += $sales['accumulated'][$id][3];
                        }
                        echo number_format($sum2, 2, ',', '.'); ?>
                        <?php $diff = ($sum1 === 0.0 ? 0.0 : 100 * ($sum2 - $sum1) / abs($sum1)); ?>
                    <th><?= number_format($sum2 - $sum1, 2, ',', '.'); ?>
                    <th><?= number_format($diff, 2, ',', '.'); ?>%
                    <th><?php $sum = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum += $sales['accumulated'][$id][4];
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum += $sales['accumulated'][$id][5];
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><?php $sum = 0.0;
                        foreach($ids['elements'] as $id) {
                            $sum += $sales['accumulated'][$id][6];
                        }
                        echo number_format($sum, 2, ',', '.'); ?>
                    <th><i class="fa fa-arrow-circle-o-right"
                           style="transform: rotate(<?= (int) rotatingTrend((int) $diff) ?>deg)"></i>
                        <?php foreach ($ids['elements'] as $id) : ?>
                <tr>
                    <th><?= $id . ' ' . $lang[$id]; ?>
                    <td><?= number_format($sales[$id][$nowm2ml], 2, ',', '.'); ?>
                    <td><?= number_format($sales[$id][$nowm1ml], 2, ',', '.'); ?>
                    <td><?= number_format($sales[$id][(int) $now->format('m') + 12], 2, ',', '.'); ?>
                    <td><?= number_format($sales[$id][(int) $now->format('m') + 24], 2, ',', '.'); ?>
                        <?php $diff = ($sales[$id][(int) $now->format('m') + 12] === 0.0 ? 0.0 : (100 * ($sales[$id][(int) $now->format('m') + 24] - $sales[$id][(int) $now->format('m') + 12]) / abs($sales[$id][(int) $now->format('m') + 12]))); ?>
                    <td class="delim coloring-<?php if($diff > 1) {
                        echo 1;
                    } elseif($diff < -1) {
                        echo -1;
                    } else {
                        echo 0;
                    } ?>"><?= number_format($sales[$id][(int) $now->format('m') + 24] - $sales[$id][(int) $now->format('m') + 12], 2, ',', '.'); ?>
                    <td class="delim coloring-<?php if($diff > 1) {
                        echo 1;
                    } elseif($diff < -1) {
                        echo -1;
                    } else {
                        echo 0;
                    } ?>"><?= number_format($diff, 2, ',', '.'); ?>%
                    <td><?= number_format($sales['accumulated'][$id][1], 2, ',', '.'); ?>
                    <td><?= number_format($sales['accumulated'][$id][2], 2, ',', '.'); ?>
                    <td><?= number_format($sales['accumulated'][$id][3], 2, ',', '.'); ?>
                        <?php $diff2 = ($sales['accumulated'][$id][2] === 0.0 ? 0.0 : (100 * ($sales['accumulated'][$id][3] - $sales['accumulated'][$id][2]) / abs($sales['accumulated'][$id][2]))); ?>
                    <td class="delim coloring-<?php if($diff2 > 1) {
                        echo 1;
                    } elseif($diff2 < -1) {
                        echo -1;
                    } else {
                        echo 0;
                    } ?>"><?= number_format($sales['accumulated'][$id][3] - $sales['accumulated'][$id][2], 2, ',', '.'); ?>
                    <td class="delim coloring-<?php if($diff2 > 1) {
                        echo 1;
                    } elseif($diff2 < -1) {
                        echo -1;
                    } else {
                        echo 0;
                    } ?>"><?= number_format($diff2, 2, ',', '.'); ?>%
                    <td><?= number_format($sales['accumulated'][$id][4], 2, ',', '.'); ?>
                    <td><?= number_format($sales['accumulated'][$id][5], 2, ',', '.'); ?>
                    <td><?= number_format($sales['accumulated'][$id][6], 2, ',', '.'); ?>
                    <td class="coloring-<?php if($diff2 > 1) {
                        echo 1;
                    } elseif($diff2 < -1) {
                        echo -1;
                    } else {
                        echo 0;
                    } ?>">
                        <i class="fa fa-arrow-circle-o-right"
                           style="transform: rotate(<?= (int) rotatingTrend((int) $diff2) ?>deg)"></i>
                        <?php endforeach; ?>
                        <?php endforeach; ?>
            </table>
        </div>
    </div>

    <div class="areamanger-box half">
        <style scoped>
            .axis path, .axis line {
                fill: none;
                stroke: #777;
                shape-rendering: crispEdges;
            }

            .axis text {
                font-size: 13px;
            }

            .legend {
                font-size: 14px;
                font-weight: bold;
            }

            .tick text {
                font-size: 12px;
            }

            .tick line {
                opacity: 0.4;
            }
        </style>

        <svg id="visualisation" width="100%" height="300"></svg>
        <?php
        $chartData  = '';
        $chartData2 = '';
        $chartData3 = '';
        $chartData4 = '';
        $first      = true;

        foreach($types as $ids) {
            $sum  = 0.0;
            $sum2 = 0.0;
            foreach($ids['elements'] as $id) {
                $sum += $sales[$id][(int) $now->format('m') + 24];
                $sum2 += $sales['accumulated'][$id][3];
            }

            if($sum > 1000) {
                $chartData3 .= '{"label": "' . $lang[$ids['title']] . '", "value": "' . $sum . '"},';
            }

            if($sum2 > 3000) {
                $chartData4 .= '{"label": "' . $lang[$ids['title']] . '", "value": "' . $sum2 . '"},';
            }
        }

        $acc = 0.0;
        for($i = 1; $i < 37; $i++) {
            $sum = 0.0;
            foreach($types as $ids) {
                foreach($ids['elements'] as $id) {
                    $sum += $sales[$id][$i];
                }
            }

            $acc += $sum;

            if($sum > 0.0 || $first) {
                $first = true;

                if($i <= 12) {
                    $title = $now2->format('Y');
                } elseif($i <= 24) {
                    $title = $now1->format('Y');
                } else {
                    $title = $now->format('Y');
                }

                $chartData .= '{ "Year": "' . $title . '", "sale": "' . $sum . '", "month": "' . (((int) $i % 12 === 0 ? 12 : (int) $i % 12)) . '" },';

                if($sum == 0.0) {
                    $first = false;
                } else {
                    $chartData2 .= '{ "Year": "' . $title . '", "sale": "' . $acc . '", "month": "' . (((int) $i % 12 === 0 ? 12 : (int) $i % 12)) . '" },';
                }
            }

            if($i % 12 === 0) {
                $acc = 0.0;
            }
        }

        $chartData  = rtrim($chartData, ',');
        $chartData2 = rtrim($chartData2, ',');
        $chartData3 = rtrim($chartData3, ',');
        ?>
    </div>

    <div class="areamanger-box half">
        <svg id="visualisation2" width="100%" height="300"></svg>
    </div>

    <div class="areamanger-box half cT">
        <svg id="visualisation3" width="600" height="250"></svg>
    </div>

    <div class="areamanger-box half cT">
        <svg id="visualisation4" width="600" height="250"></svg>
    </div>
</div>
