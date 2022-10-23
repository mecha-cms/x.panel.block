<?php

// Disable this extension if `block` extension is disabled or removed ;)
if (!isset($state->x->block)) {
    return $_;
}

Hook::set('_', function ($_) use ($user) {
    if (isset($_['lot']['bar']['lot'][0]['lot']['folder']['lot']['block'])) {
        $_['lot']['bar']['lot'][0]['lot']['folder']['lot']['block']['icon'] = 'M2,4C2,2.89 2.9,2 4,2H7V4H4V7H2V4M22,4V7H20V4H17V2H20A2,2 0 0,1 22,4M20,20V17H22V20C22,21.11 21.1,22 20,22H17V20H20M2,20V17H4V20H7V22H4A2,2 0 0,1 2,20M10,2H14V4H10V2M10,20H14V22H10V20M20,10H22V14H20V10M2,10H4V14H2V10Z';
        $_['lot']['bar']['lot'][0]['lot']['folder']['lot']['block']['skip'] = false; // This will make `.\lot\block` folder always visible!
    }
    return $_;
}, 0);

return $_;