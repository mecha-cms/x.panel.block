<?php

// Disable this extension if `block` extension is disabled or removed ;)
if (!isset($state->x->block)) {
    return $_;
}

if ('POST' === $_SERVER['REQUEST_METHOD'] && 0 === strpos($_['path'] . '/', 'block/') && 0 === strpos($_['type'] . '/', 'file/block/')) {
    // Force `.php` file extension
    if (isset($_POST['file']['name'])) {
        $_POST['file']['name'] .= '.php';
    }
}

if (0 === strpos($_['path'] . '/', 'block/') && !array_key_exists('type', $_GET) && !isset($_['type'])) {
    if (!empty($_['part']) && $_['folder']) {
        $_['type'] = 'files/block';
    } else if (empty($_['part']) && $_['file']) {
        $x = pathinfo($_['file'], PATHINFO_EXTENSION);
        if ('php' === $x) {
            $_['type'] = 'file/block';
        }
    }
}

Hook::set('_', function ($_) {
    if (isset($_['lot']['bar']['lot'][0]['lot']['folder']['lot']['block'])) {
        $_['lot']['bar']['lot'][0]['lot']['folder']['lot']['block']['icon'] = 'M2,4C2,2.89 2.9,2 4,2H7V4H4V7H2V4M22,4V7H20V4H17V2H20A2,2 0 0,1 22,4M20,20V17H22V20C22,21.11 21.1,22 20,22H17V20H20M2,20V17H4V20H7V22H4A2,2 0 0,1 2,20M10,2H14V4H10V2M10,20H14V22H10V20M20,10H22V14H20V10M2,10H4V14H2V10Z';
        $_['lot']['bar']['lot'][0]['lot']['folder']['lot']['block']['skip'] = false; // This will make `.\lot\block` folder always visible!
    }
    if (0 === strpos($_['path'] . '/', 'block/')) {
        if (0 === strpos($_['type'] . '/', 'file/block/')) {
            if (isset($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['name'])) {
                $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['name']['unit'] = '.php';
                $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['name']['x'] = false;
                if ('get' === $_['task'] && isset($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['name']['value'])) {
                    $_['lot']['bar']['lot'][0]['lot']['set']['description'][1] = 'Block';
                    $_['lot']['bar']['lot'][0]['lot']['set']['icon'] = 'M2,4C2,2.89 2.9,2 4,2H7V4H4V7H2V4M22,4V7H20V4H17V2H20A2,2 0 0,1 22,4M20,20V17H22V20C22,21.11 21.1,22 20,22H17V20H20M2,20V17H4V20H7V22H4A2,2 0 0,1 2,20M10,2H14V4H10V2M10,20H14V22H10V20M20,10H22V14H20V10M2,10H4V14H2V10Z';
                    $_['lot']['bar']['lot'][0]['lot']['set']['url']['query']['type'] = 'file/block';
                    $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['name']['value'] = pathinfo($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['name']['value'], PATHINFO_FILENAME);
                }
                if ('set' === $_['task'] && isset($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['content'])) {
                    $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['content']['value'] = '<?php

return function ($content, $data) {
    // `$content` holds the literal block string.
    // `$data` holds the parsed block data where the first data is the block name, the second data is the block content and the third data is the block attributes.
    // `$this` refers to the current `$page` variable.
};';
                }
            }
        } else if (0 === strpos($_['type'] . '/', 'files/block/')) {
            $_['lot']['desk']['lot']['form']['lot'][0]['lot']['tasks']['lot']['blob']['skip'] = true; // Disable blob button
            $_['lot']['desk']['lot']['form']['lot'][0]['lot']['tasks']['lot']['file']['description'][1] = 'Block';
            $_['lot']['desk']['lot']['form']['lot'][0]['lot']['tasks']['lot']['file']['title'] = 'Block';
            $_['lot']['desk']['lot']['form']['lot'][0]['lot']['tasks']['lot']['file']['url']['query']['type'] = 'file/block';
            $_['lot']['desk']['lot']['form']['lot'][0]['lot']['tasks']['lot']['folder']['skip'] = true; // Disable folder button
        }
    }
    return $_;
}, 0);

Hook::set('_', function ($_) {
    if (0 !== strpos($_['type'] . '/', 'files/block/')) {
        return $_;
    }
    if (
        !empty($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['files']['lot']['files']['lot']) &&
        !empty($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['files']['lot']['files']['type']) &&
        'files' === $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['files']['lot']['files']['type']
    ) {
        foreach ($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['files']['lot']['files']['lot'] as $k => &$v) {
            $v['is']['file'] = false;
            $v['is']['folder'] = false;
            $v['title'] = '[[' . basename($k, '.php') . ']]';
        }
        unset($v);
    }
    return $_;
}, 10.1);

return $_;