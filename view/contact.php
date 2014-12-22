<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $contact->name; ?></title>
    </head>
    <body>
        <h1><?php echo $contact->name; ?></h1>
        <div>
            <span class="label">Phone:</span>
            <?php echo $contact->phone; ?>
        </div>
        <div>
            <span class="label">Email:</span>
            <?php echo $contact->email; ?>
        </div>
        <div>
            <span class="label">Address:</span>
            <?php echo $contact->address; ?>
        </div>
    </body>
</html>