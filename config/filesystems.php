<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
        ],
        
        'gcs' => [
            'driver' => 'gcs',
            'project_id' => env('GOOGLE_CLOUD_PROJECT_ID', 'your-project-id'),
            'key_file' => [
                            "type"=> "service_account",
                            "project_id"=> "aqueous-charger-270720",
                            "private_key_id"=> "bdaddfaf21f0eb2646e55f56f66e6d381e954a8a",
                            "private_key"=> "-----BEGIN PRIVATE KEY-----\nMIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCXtM74LIzavPGT\nLeYrmIfb1xlATpdTEdOMxva5BVXqvVn2IZIBO2s4kmDrsBqredgQLTHgGmFWlP2t\nDXjM+ZCPvY/QXUArYCtVagl6DyJwhp4nLl1K37fVxYVksqThtj1SqOsgXbSlv9LW\n1parrCAenzU3McS/P+BX+VBQY7oI5UyV3i2QaV62miWrV0bhXpm7lZm3Rq/i+dt3\nWwjeZwsc/wN3bQT1x2CAM3Oiq14AN1i7zlrDr5NRI+eg29PTECf7lfNYpBFHl8YR\njseSFCiw1uR4pjCOcTcL0cgKAmn64Zf/IpEA07LQtZkwfaUYAsRCs/2eMW0euKo9\npB3rA8CDAgMBAAECggEAAzi2aaQkjGNiK+WkubzgK0wN8x6LU+fEGsnoCyjKWMhG\nZOKONt/iPueY237Rw8Q8Hg45PQP1mJpkXEYcQ4Byae/Oe7aNoMr56jMf88tNFQYL\nmlOZOcUdCPlltxKcfr1ZRjj936H6lPrivGfLkX/mIYOKMUH2ZoTlCJxr1xeVdHZF\nswOldAL5UfD1dGcKyC4OUsbCRN3VOV7iaWw9/JkzsPqLcBzBMuGE0pep81lmiGe5\nPsOgxbeVCw4YuFt1p5G6fUakIpnVK6bXcbRjdisVfmCg07lgmOm5NP/4x0ImFOLi\nKFdMh8vBHAtGjur714oQQlG1RUhkZ2q0+85Bxmh7OQKBgQDQ9UPDYcZ4nQN1XhYX\nG0GwUWnoUCm16l3i+QJnZuC8hyGk7g4Lfs2aBJOSPZ/5r1q0SSCKpZks8frWYjTE\no4zg8dFO31MrDX57yX6ETSyON3Pl/cEqQndaVFcCmf6eAOvKFDD6e0MXA2qkjITL\n+1AIPOjMbuo4E8GGeqgzNdqFWQKBgQC52/3Te0hHxf0AShKrSmtm0wYtfT3i6/0n\nSdsjzgTYsmgi6J7WzW2Ib25otEeeoFEgj0mqRWyDWuKxi5VOYnziO+gbBTuHpNdm\nnoy6XWXtYvDorDEZ9msKoDIY9nBWQwfXcRYbWe9uwOEJwkdmsUDaTbkqyPRzmg5o\ns/K0YD2NOwKBgDCd3/ZFeXf2kCdujJUzskTjrFBw1kONE+sLJJQKS5+RkTJecMYb\n6po7FlqgG+hr9B6eJQQdI1ZhtorKrpxRsSVlHd3L9/28VgFXECiYDBXKsRyBvb+n\nVz2dAeGJEsSQUkviBsNAiouAL/+48ezDvAsuoLtv0u7ZKd2wDBJeJUmBAoGAeP1s\nHErJ/+c0TwbpZlaY2iQPhndcXSew8e2TWZiY8RQa1HbISB8M6d9YaZLKeMn2ZhLB\nKrXs8QmuP1QViyR0FbZX35clbKTzkBswk3WPj9xz5ZOKl1Mh1ZX5ZuSutokGRsqY\nUI/YXSn0lSzC3GgRRsuH+gE9mS+1p5VVLvTjvNcCgYA46YgFAlbveDZ/Z90Vf5kY\nEpBpzLPokddD1GQdOjxnVV3WQgWDNpMh399UYLzQDN0Y9uYxqk8FZP0wmgSBIUja\n8KjQjaOxQ96nt38s67jTJOnJTnQQRW+CZrjgXc5JYmCa8OiUKvVwLRDyW+l/oBPx\nZ7x4nBIRY+S5OYSVbS+c+Q==\n-----END PRIVATE KEY-----\n",
                            "client_email"=> "test-81@aqueous-charger-270720.iam.gserviceaccount.com",
                            "client_id"=> "115057569702274410228",
                            "auth_uri"=> "https://accounts.google.com/o/oauth2/auth",
                            "token_uri"=> "https://oauth2.googleapis.com/token",
                            "auth_provider_x509_cert_url"=> "https://www.googleapis.com/oauth2/v1/certs",
                            "client_x509_cert_url"=> "https://www.googleapis.com/robot/v1/metadata/x509/test-81%40aqueous-charger-270720.iam.gserviceaccount.com"
                        ], // optional: /path/to/service-account.json
            'bucket' => env('GOOGLE_CLOUD_STORAGE_BUCKET', 'your-bucket'),
            'path_prefix' => env('GOOGLE_CLOUD_STORAGE_PATH_PREFIX', null), // optional: /default/path/to/apply/in/bucket
            'storage_api_uri' => env('GOOGLE_CLOUD_STORAGE_API_URI', null), // see: Public URLs below
            'visibility' => 'public', // optional: public|private
        ],

    ],

];
