<?php declare(strict_types=1);
$fiscal_end        = new \phpOMS\Stdlib\Base\SmartDateTime('2016/06/30');
$fiscal_current    = new \phpOMS\Stdlib\Base\SmartDateTime('2015/09/30');
$fiscal_start      = new \phpOMS\Stdlib\Base\SmartDateTime('2015/07/01');
$fiscal_start_prev = $fiscal_start->createModify(-1);
$fiscal_end_prev   = $fiscal_end->createModify(-1);

$acDef      = [];
$ccDef      = [];
$coDef      = [];
$acDef      = [];
$ccDef      = [];
$coDef      = [];
$courseList = [];
$month      = 1;

if (($path = \realpath($oPath = __DIR__ . '/' . $rcoll['crm.csv']->getPath())) !== false) {
    $file = \fopen($path, 'r');
    while (($line = \fgetcsv($file, 0, ';', '"')) !== false) {
        $courseList[$line[0]] = $line;
    }
    \fclose($file);
}

if (($path = \realpath($oPath = __DIR__ . '/' . $rcoll['accounts.csv']->getPath())) !== false) {
    $file = \fopen($path, 'r');
    while (($line = \fgetcsv($file, 0, ';', '"')) !== false) {
        $acDef[$line[0]] = $line[1];
    }
    \fclose($file);
}

if (($path = \realpath($oPath = __DIR__ . '/' . $rcoll['costcenters.csv']->getPath())) !== false) {
    $file = \fopen($path, 'r');
    while (($line = \fgetcsv($file, 0, ';', '"')) !== false) {
        $ccDef[$line[0]] = $line[1];
    }
    \fclose($file);
}

if (($path = \realpath($oPath = __DIR__ . '/' . $rcoll['costobjects.csv']->getPath())) !== false) {
    $file = \fopen($path, 'r');
    while (($line = \fgetcsv($file, 0, ';', '"')) !== false) {
        $coDef[$line[0]] = $line[1];
    }
    \fclose($file);
}

$accounts = [
    4450, 4455, 4480, 4482, 4483, 4484, 4485, 4490, 4653, 4671,
];

$types = [
    'A' => 'EventCourseInt',
    'B' => 'Advice',
    'D' => 'Demo',
    'E' => 'Briefing',
    'I' => 'IMPLA',
    'K' => 'Course',
    'M' => 'MarketingSupport',
    'P' => 'Promotion',
    'R' => 'CourseRosbach',
    'S' => 'Roadshow',
    'U' => 'AdditionalSupport',
    'V' => 'Event',
    ''  => 'Unknown',
];

$account    = [];
$type       = [];
$costcenter = [];
$costobject = [];

$total = [];

if (($path = \realpath($oPath = __DIR__ . '/' . $rcoll['entries.csv']->getPath())) !== false) {
    $file = \fopen($path, 'r');
    while (($line = \fgetcsv($file, 0, ',', '"')) !== false) {
        if (\in_array($line[10], $accounts)) {
            $date  = new \phpOMS\Stdlib\Base\SmartDateTime($line[0]);
            $year  = (int) $date->format('Y');
            $month = (int) $date->format('m');

            $val_1 = (float) \str_replace(['.', ','], ['', '.'], $line[3]);
            $val_2 = (float) \str_replace(['.', ','], ['', '.'], $line[4]);
            $val   = $val_1 - $val_2;

            $t_name = empty($line[9]) ? '' : \substr($line[9], 0, 1);

            if (!isset($account[$line[10]][$year][$month])) {
                $account[$line[10]][$year][$month] = 0.0;
            }

            if (!isset($type[$t_name][$year][$month])) {
                $type[$t_name][$year][$month] = 0.0;
            }

            if (!isset($costcenter[$line[8]][$year][$month])) {
                $costcenter[$line[8]][$year][$month] = 0.0;
            }

            if (!isset($costobject[$line[9]][$year][$month])) {
                $costobject[$line[9]][$year][$month] = 0.0;
            }

            $account[$line[10]][$year][$month] += $val;
            $type[$t_name][$year][$month] += $val;
            $costcenter[$line[8]][$year][$month] += $val;
            $costobject[$line[9]][$year][$month] += $val;

            // Now
            if ($date->getTimestamp() >= $fiscal_start->getTimestamp() && $date->getTimestamp() <= $fiscal_current->getTimestamp()) {
                $fiscal_year = $fiscal_end->format('Y');
            } elseif ($date->getTimestamp() >= $fiscal_start_prev->getTimestamp() && $date->getTimestamp() <= $fiscal_end_prev->getTimestamp()) {
                $fiscal_year = $fiscal_end_prev->format('Y');
            } else {
                continue;
            }

            if (!isset($account[$line[10]][$fiscal_year]['value'])) {
                $account[$line[10]][$fiscal_year]['value'] = 0.0;
            }

            if (!isset($account[$line[10]][$fiscal_year]['cc'][$line[8]])) {
                $account[$line[10]][$fiscal_year]['cc'][$line[8]] = 0.0;
            }

            if (!isset($account[$line[10]][$fiscal_year]['type'][$t_name])) {
                $account[$line[10]][$fiscal_year]['type'][$t_name] = 0.0;
            }

            if (!isset($account[$line[10]][$fiscal_year]['co'][$line[9]])) {
                $account[$line[10]][$fiscal_year]['co'][$line[9]] = 0.0;
            }

            if (!isset($type[$t_name][$fiscal_year]['value'])) {
                $type[$t_name][$fiscal_year]['value'] = 0.0;
            }

            if (!isset($type[$t_name][$fiscal_year]['cc'][$line[8]])) {
                $type[$t_name][$fiscal_year]['cc'][$line[8]] = 0.0;
            }

            if (!isset($type[$t_name][$fiscal_year]['ac'][$line[10]])) {
                $type[$t_name][$fiscal_year]['ac'][$line[10]] = 0.0;
            }

            if (!isset($costcenter[$line[8]][$fiscal_year]['value'])) {
                $costcenter[$line[8]][$fiscal_year]['value'] = 0.0;
            }

            if (!isset($costcenter[$line[8]][$fiscal_year]['co'][$line[9]])) {
                $costcenter[$line[8]][$fiscal_year]['co'][$line[9]] = 0.0;
            }

            if (!isset($costcenter[$line[8]][$fiscal_year]['ac'][$line[10]])) {
                $costcenter[$line[8]][$fiscal_year]['ac'][$line[10]] = 0.0;
            }

            if (!isset($costcenter[$line[8]][$fiscal_year]['type'][$t_name])) {
                $costcenter[$line[8]][$fiscal_year]['type'][$t_name] = 0.0;
            }

            if (!isset($costobject[$line[9]][$fiscal_year]['value'])) {
                $costobject[$line[9]][$fiscal_year]['value'] = 0.0;
            }

            if (!isset($costobject[$line[9]][$fiscal_year]['ac'][$line[10]])) {
                $costobject[$line[9]][$fiscal_year]['ac'][$line[10]] = 0.0;
            }

            if (!isset($costobject[$line[9]][$fiscal_year]['cc'][$line[8]])) {
                $costobject[$line[9]][$fiscal_year]['cc'][$line[8]] = 0.0;
            }

            $account[$line[10]][$fiscal_year]['value'] += $val;
            $account[$line[10]][$fiscal_year]['cc'][$line[8]] += $val;
            $account[$line[10]][$fiscal_year]['type'][$t_name] += $val;
            $type[$t_name][$fiscal_year]['value'] += $val;
            $type[$t_name][$fiscal_year]['cc'][$line[8]] += $val;
            $type[$t_name][$fiscal_year]['ac'][$line[10]] += $val;
            $costcenter[$line[8]][$fiscal_year]['value'] += $val;
            $costcenter[$line[8]][$fiscal_year]['co'][$line[9]] += $val;
            $costcenter[$line[8]][$fiscal_year]['ac'][$line[10]] += $val;
            $costcenter[$line[8]][$fiscal_year]['type'][$t_name] += $val;
            $costobject[$line[9]][$fiscal_year]['value'] += $val;
            $costobject[$line[9]][$fiscal_year]['ac'][$line[10]] += $val;
            $costobject[$line[9]][$fiscal_year]['cc'][$line[8]] += $val;

            if (!isset($total[$fiscal_year])) {
                $total[$fiscal_year] = 0.0;
            }

            $total[$fiscal_year] += $val;
        }
    }
    \fclose($file);
}
