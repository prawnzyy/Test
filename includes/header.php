<!-- header.php -->
<!-- This is used for page navigations, feel free to change -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'NUSGS Test Page'; ?></title>
    <link rel="stylesheet" href="/css/style.css"> <!-- Your stylesheet -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<header>
    <h1>NUSGS Test Website</h1>
    <nav>
        <div>
            <a href="/index.php">Home</a>
            <a href="/src/forms/modules.php">Form</a>
        </div>
    </nav>
</header>