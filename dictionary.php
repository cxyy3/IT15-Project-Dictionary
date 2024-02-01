<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $word = urlencode(strtolower($_POST['word']));
    $api_key = 'https://api.dictionaryapi.dev/api/v2/entries/en/';

    if ($word && $api_key) {
        $api_url = $api_key . $word;

        $curl = curl_init($api_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if ($http_code == 200) {
            $data = json_decode($response, true);

            if (!empty($data)) {
                $_SESSION['last_definition'] = [
                    'word' => $data[0]['word'],
                    'definitions' => []
                ];

                foreach ($data[0]['meanings'] as $meaning) {
                    $_SESSION['last_definition']['definitions'][] = [
                        'partOfSpeech' => $meaning['partOfSpeech'],
                        'definition' => $meaning['definitions'][0]['definition']
                    ];
                }

                echo '<div class="alert alert-success" role="alert">';
                echo '<strong>' . $_SESSION['last_definition']['word'] . ':</strong>';

                foreach ($_SESSION['last_definition']['definitions'] as $definition) {
                    echo '<p>' . $definition['partOfSpeech'] . ': ' . $definition['definition'] . '</p>';
                }

                echo '</div>';
            } else {
                echo '<div class="alert alert-warning" role="alert">Definition not found for the word.</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Failed to fetch data. Please try again later.</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Invalid API key or word.</div>';
    }
}
?>
