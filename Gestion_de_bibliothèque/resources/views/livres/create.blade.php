<!DOCTYPE html>
<html>
<head>
    <title>Créer un livre</title>
</head>
<body>
    <h1>Ajouter un livre</h1>
    <form method="POST" action="/livres">
        @csrf
        <label>Titre :</label>
        <input type="text" name="titre"><br>

        <label>Auteur :</label>
        <input type="text" name="auteur"><br>

        <label>ISBN :</label>
        <input type="text" name="isbn"><br>

        <label>Exemplaires :</label>
        <input type="number" name="exemplaires"><br>

        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>
