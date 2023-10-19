<?php

function getLastFm() {

    $user     = 'josephtatum'; // Enter your username here
    $key      = 'b25ee16830a87e81d1b3a0c98375d811'; // Enter your API Key
    $status   = 'Last Played:'; // default to this, if 'Now Playing' is true, the json will reflect this.
    $endpoint = 'https://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user=' . $user . '&&limit=2&api_key=' . $key . '&format=json';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); // 0 for indefinite
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); // 10 second attempt before timing out
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));

    $response = curl_exec($ch);
    $lastfm[] = json_decode($response, true);

    curl_close($ch);

    $artwork = $lastfm[0]['recenttracks']['track'][0]['image'][2]['#text'];

    if ( empty( $artwork ) ) {
        $artwork = 'artwork-fallback.png';
    }

    $trackInfo = [
        'name'       => $lastfm[0]['recenttracks']['track'][0]['name'],
        'artist'     => $lastfm[0]['recenttracks']['track'][0]['artist']['#text'],
        'status'     => $status
    ];

    if ( !empty($lastfm[0]['recenttracks']['track'][0]['@attr']['nowplaying']) ) {
        $trackInfo['nowPlaying'] = $lastfm[0]['recenttracks']['track'][0]['@attr']['nowplaying'];
        $trackInfo['status'] = 'Now Playing:';
        return displayLastFM($trackInfo);
    } else {
        return "not playing anything";
    }
}

/*-------------
Secondary function to display
the track info on the frontend
--------------*/

function displayLastFM($trackInfo) { ?>
    <span class="mb-4 ml-0">
        currently listening to
        <span class="font-bold">
            <a
                target="_blank"
                rel="noreferrer"
                href='https://www.youtube.com/results?search_query=<?php echo $trackInfo['name']; ?>+<?php echo $trackInfo['artist'] ?>'
            >
            <?php echo $trackInfo['name']; ?>
            </a>
        </span>
        by <span class="font-bold"><?php echo $trackInfo['artist'] ?>.</span>
    </span>
<?php } ?>