<?php

use App\Model\Category;
use App\Model\Product;
use App\Model\Item;
use App\Model\Location;
use App\Model\Client;

$categories = [
    'Chaussure' => [
        'Chaussure de ski',
        'Chaussure de randonnée'
    ],
    'Ski' => [
        'Ski de fond',
        'Ski de piste'
    ],
    'Vélo' => [
        'VTT',
        'BMX',
        'Vélo de route',
        'Tandem'
    ],
    'Divers' => []
];

$products = [
    [
        'name'        => 'HAWX MAGNA 110 ATOMIC',
        'prix'        =>  75.00
    ],
    [
        'name'        => 'ADVANTEDGE 105 HEAD',
        'prix'        =>  60.00
    ],
    [
        'name'        => 'ALLTRACK 120 ROSSIGNOL',
        'prix'        =>  50.00
    ]
];

$items = [
    [
        'code'        => '3004510913468',
        'status'      =>  'loué',
        'reparations' =>  'aucune réparation envisagée',
        'remarques'   =>  'pas de remarques particulières',
        'product'     => 1
    ],
    [
        'code'        => '3009010534441',
        'status'      =>  'disponible',
        'reparations' =>  'aucune réparation envisagée',
        'remarques'   =>  'pas de remarques particulières',
        'product'     => 2
    ],
    [
        'code'        => '3001732687696',
        'status'      =>  'loué',
        'reparations' =>  'aucune réparation envisagée',
        'remarques'   =>  'pas de remarques particulières',
        'product'     => 1
    ]
];

$locations = [
    [
        'date_debut' => '2017-03-09',
        'date_fin' => '2017-03-09',
        'status' => 'active',
        'prix' => 130,
        'client_id' => 1
    ],
    [
        'date_debut' => '2017-03-09',
        'date_fin' => '2017-03-09',
        'status' => 'active',
        'prix' => 150,
        'client_id' => 1
    ],
    [
        'date_debut' => '2017-03-09',
        'date_fin' => '2017-03-09',
        'status' => 'active',
        'prix' => 140,
        'client_id' => 2
    ]
];


$clients = [
    [
        'nom' => 'zakaria',
        'prenom' => 'elouarchi',
        'organisme' => 'UNIV LORRAINE',
        'adresse' => '17 rue du sangl',
        'telephone' => '0767767867',
        'email' => 're@gmail.com'
    ],
    [
        'nom' => 'kamel',
        'prenom' => 'remaki',
        'organisme' => 'IUT nancy',
        'adresse' => '8 rue aristid briand',
        'telephone' => '0667767867',
        'email' => 'kamel@gmail.com'
    ],
];

foreach ($categories as $category => $subCategories) {
    $c = new Category([
        'name' => $category
    ]);
    $c->save();

    foreach ($subCategories as $subCategory) {
        $sub = new Category([
            'name' => $subCategory
        ]);
        $sub->parent()->associate($c);
        $sub->save();
    }
}

foreach ($products as $product) {
    $p = new Product([
        'name' => $product['name'],
        'prix' => $product['prix']
    ]);
    $p->save();

    $p->categories()->attach(2);
}

foreach ($items as $item) {
    $i = new Item([
        'code' => $item['code'],
        'status' => $item['status'],
        'reparations' => $item['reparations'],
        'remarques' => $item['remarques'],
        'purchased_at' => new \DateTime()
    ]);
    $i->product()->associate($item['product']);
    $i->save();
}

foreach ($clients as $client) {
    $cl = new Client($client);
    $cl->save();
}

foreach ($locations as $location) {
    $l = new Location([
        'date_debut' => $location['date_debut'],
        'date_fin' => $location['date_fin'],
        'status' => $location['status'],
        'prix' => $location['prix']
    ]);

    $l->client()->associate($location['client_id']);
    $l->save();
    $l->items()->attach([1, 2]);
}
