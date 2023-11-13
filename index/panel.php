<?php

namespace {
    // Disable this extension if `block` extension is disabled or removed ;)
    if (!isset($state->x->block)) {
        return $_;
    }
    if ('POST' === $_SERVER['REQUEST_METHOD'] && 0 === \strpos($_['path'] . '/', 'block/') && 0 === \strpos($_['type'] . '/', 'file/block/')) {
        if ($name = $_POST['file']['name'] ?? "") {
            // Check if block already exists as a hook
            if (\Hook::get('block.' . $name)) {
                $_['alert']['error'][] = ['Block %s already exists as a hook.', '<code>[[' . $name . ']]</code>'];
            }
            // Force `.php` file extension
            $_POST['file']['name'] .= '.php';
        }
    }
    if (0 === \strpos($_['path'] . '/', 'block/') && !\array_key_exists('type', $_GET) && !isset($_['type'])) {
        if (!empty($_['part']) && $_['folder']) {
            $_['type'] = 'files/block';
        } else if (empty($_['part']) && $_['file']) {
            $x = \pathinfo($_['file'], \PATHINFO_EXTENSION);
            if ('php' === $x) {
                $_['type'] = 'file/block';
            }
        }
    }
}

namespace x\panel__block {
    function _($_) {
        if (isset($_['lot']['bar']['lot'][0]['lot']['folder']['lot']['block'])) {
            $_['lot']['bar']['lot'][0]['lot']['folder']['lot']['block']['icon'] = 'M2,4C2,2.89 2.9,2 4,2H7V4H4V7H2V4M22,4V7H20V4H17V2H20A2,2 0 0,1 22,4M20,20V17H22V20C22,21.11 21.1,22 20,22H17V20H20M2,20V17H4V20H7V22H4A2,2 0 0,1 2,20M10,2H14V4H10V2M10,20H14V22H10V20M20,10H22V14H20V10M2,10H4V14H2V10Z';
            $_['lot']['bar']['lot'][0]['lot']['folder']['lot']['block']['skip'] = false; // This makes `.\lot\block` folder always visible!
        }
        if (0 !== \strpos($_['path'] . '/', 'block/')) {
            return $_;
        }
        if (0 !== \strpos($_['type'] . '/', 'file/block/')) {
            return $_;
        }
        if (!isset($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['name'])) {
            return $_;
        }
        $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['name']['unit'] = '.php';
        $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['name']['x'] = false;
        if ('get' === $_['task'] && isset($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['name']['value'])) {
            $_['lot']['bar']['lot'][0]['lot']['set']['description'][1] = 'Block';
            $_['lot']['bar']['lot'][0]['lot']['set']['url']['query']['type'] = 'file/block';
            $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['name']['value'] = \pathinfo($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['name']['value'], \PATHINFO_FILENAME);
        }
        if ('set' === $_['task'] && isset($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['content'])) {
            $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['content']['value'] = '<?' . 'php

return function ($content, $lot) {
    // `$content` is the string of the literal block.
    // `$lot` is the data of the parsed block, where the first data is the name of the block, the second data is the content of the block, and the third data is the attributes of the block.
    // `$this` refers to the current `$page` variable.
};';
        }
        return $_;
    }
    \Hook::set('_', __NAMESPACE__ . "\\_", 0);
}

namespace x\panel__block\_ {
    function files($_) {
        if (0 !== \strpos($_['type'] . '/', 'files/block/')) {
            return $_;
        }
        $_['lot']['desk']['lot']['form']['lot'][0]['lot']['tasks']['lot']['blob']['skip'] = true; // Disable blob button
        $_['lot']['desk']['lot']['form']['lot'][0]['lot']['tasks']['lot']['file']['description'][1] = 'Block';
        $_['lot']['desk']['lot']['form']['lot'][0]['lot']['tasks']['lot']['file']['title'] = 'Block';
        $_['lot']['desk']['lot']['form']['lot'][0]['lot']['tasks']['lot']['file']['url']['query']['type'] = 'file/block';
        $_['lot']['desk']['lot']['form']['lot'][0]['lot']['tasks']['lot']['folder']['skip'] = true; // Disable folder button
        if (
            !empty($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['files']['lot']['files']['lot']) &&
            !empty($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['files']['lot']['files']['type']) &&
            0 === \strpos($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['files']['lot']['files']['type'] . '/', 'files/')
        ) {
            $hooks = \Hook::get();
            foreach ($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['files']['lot']['files']['lot'] as $k => &$v) {
                $n = \basename($k, '.php');
                $v['is']['file'] = false;
                $v['is']['folder'] = false;
                $v['link'] = $v['url'] = false;
                $v['tags']['code'] = true;
                $v['title'] = '[[' . $n . ']]';
                unset($hooks['block.' . $n]);
            }
            unset($v);
        }
        if ($hooks) {
            foreach ($hooks as $k => $v) {
                if (0 !== \strpos($k, 'block.')) {
                    continue;
                }
                $n = \substr($k, 6);
                $page = new \Page;
                $skip = true;
                $stack = 1000;
                if (\is_file($file = __DIR__ . \D . '..' . \D . '..' . \D . 'block.' . $n . \D . 'index.php')) {
                    $skip = false;
                    // Prioritize name from the `composer.json` file
                    if (\is_file($file_composer = \dirname($file) . \D . 'composer.json')) {
                        $composer = \json_decode(\file_get_contents($file_composer));
                        $page = new \Page(null, [
                            'title' => $composer->name ?? ""
                        ]);
                    } else if (\is_file($file_about = \dirname($file) . \D . 'about.page')) {
                        $page = new \Page($file_about);
                    }
                }
                $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['files']['lot']['files']['lot']['#' . $n] = [
                    'is' => [
                        'file' => false,
                        'folder' => false
                    ],
                    'link' => $link = [
                        'hash' => null,
                        'part' => 1,
                        'path' => 'x/' . \basename(\dirname($page->path ?? $file)),
                        'query' => \x\panel\_query_set(['tab' => ['info']]),
                        'task' => 'get'
                    ],
                    'skip' => $skip,
                    'stack' => ($stack = $stack += 0.1),
                    'tags' => ['code' => true],
                    'tasks' => [
                        'link' => [
                            'description' => ['Refer to the %s extension', '&#x201c;' . ($page->title ?? \basename(\dirname($file))) . '&#x201d;'],
                            'icon' => 'M14,3V5H17.59L7.76,14.83L9.17,16.24L19,6.41V10H21V3M19,19H5V5H12V3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V12H19V19Z',
                            'link' => $link,
                            'stack' => 10,
                            'title' => 'Link'
                        ],
                        'let' => [
                            'active' => false,
                            'icon' => 'M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19M8,9H16V19H8V9M15.5,4L14.5,3H9.5L8.5,4H5V6H19V4H15.5Z',
                            'stack' => 20,
                        ]
                    ],
                    'title' => '[[' . $n . ']]',
                    'url' => false
                ];
            }
        }
        return $_;
    }
    \Hook::set('_', __NAMESPACE__ . "\\files", 10.1);
}