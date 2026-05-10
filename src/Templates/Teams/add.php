<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Accueil</title>
  </head>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <body>
    <form method="post">
        <input value="@token" type="hidden" name="token" />
        <div>
            <label>Nom / Identifiant</label>
            <input type="text" name="name" />
        </div>
        <input type="submit" value="Valider" />
    </form>
  </body>
</html>