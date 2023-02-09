<!DOCTYPE html>
<html lang="en" class="h-100">
<Head title="Error" />
<body class="h-100">
    <main class="container d-flex flex-column align-items-center pt-5">
        <h1><?= $props->status_code ?? ''; ?></h1>
        <p><?= rtrim($props->messsage ?? 'An error occured', '.').'.'; ?></p>
    </main>
</body>
</html>