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
        <label>Login</label>
        <input type="text" name="login" required />

        <label>Mot de passe</label>
        <input type="password" name="password" required />

        <input type="hidden" name="token" value="@token" />

        <input type="submit" value="Se connecter" />
    </form>
  </body>
</html>