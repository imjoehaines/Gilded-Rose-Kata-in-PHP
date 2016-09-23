<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dbpath = realpath(__DIR__ . '/../db.sq3');
$db = new PDO('sqlite:' . $dbpath);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['name']) && isset($_POST['quality']) && isset($_POST['sell_in'])) {
    $stmt = $db->prepare(
        'INSERT INTO items (name, quality, sell_in)
        VALUES (:name, :quality, :sell_in);'
    );

    $stmt->execute(['name' => $_POST['name'], 'quality' => $_POST['quality'], 'sell_in' => $_POST['sell_in']]);
}

$stmt = $db->prepare('SELECT * FROM items ORDER BY sell_in ASC;');
$stmt->execute();

$items = array_reduce($stmt->fetchAll(), function ($carry, $item) {
    $class = 'App\\' . $item['name'];

    return array_merge($carry, [new $class($item['quality'], $item['sell_in'])]);
}, []);

?>

<html>
    <head>
        <title>The Gilded Rose</title>

        <link rel="stylesheet" href="/marx.min.css" />
        <link rel="stylesheet" href="/style.css" />
    </head>

    <body>
        <main>
            <header>
                <h1>The Gilded Rose</h1>
            </header>

            <section>
                <h2>Items in stock</h2>

                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quality</th>
                            <th>Sell in <em>x</em> days</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item) : ?>
                            <tr>
                                <td><?php echo $item->getName(); ?></td>
                                <td><?php echo $item->getQuality(); ?></td>
                                <td><?php echo $item->getSellIn(); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <form action="index.php" method="POST">
                    <button>Tick</button>
                </form>
            </section>

            <aside>
                <h2>Add new item</h2>

                <form action="index.php" method="POST">
                    <label for="name">Name</label>
                    <select name="name" id="name">
                        <option value="AgedBrie">Aged Brie</option>
                        <option value="BackstagePasses">Backstage Passes</option>
                        <option value="Normal">Normal</option>
                        <option value="SulfurasHandOfRagnaros">Sulfuras, Hand of Ragnaros</option>
                    </select>

                    <label for="quality">Quality</label>
                    <input type="number" name="quality" id="quality">

                    <label for="sell_in">Sell In <em>x</em> Days</label>
                    <input type="number" name="sell_in" id="sell_in">

                    <button>Save</button>
                </form>
            </aside>
        </main>
    </body>
</html>
