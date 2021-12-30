<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h2>Création d'un nouveau manuscrit</h2>
    <p>Un nouveau manuscrit a été crée sur la plateforme avec les éléments suivants :</p>
    <ul>
      <li><strong>Titre du manuscrit</strong> : {{ $contact['title'] }}</li>
      <li><strong>Type du manuscrit</strong> : {{ $contact['type'] }}</li>
      <li><strong>Langue du manuscrit</strong> : {{ $contact['language'] }}</li>
      <li><strong>Abstract du manuscrit</strong> : {{ $contact['abstract'] }}</li>
      <li><strong>Mots clés</strong> : {{ $contact['keywords'] }}</li>
      <li><strong>Nombre d'auteurs</strong> : {{ $contact['numbers_of_authors'] }}</li>
      <li><strong>Nombre de figures</strong> : {{ $contact['numbers_of_figures'] }}</li>
    </ul>
  </body>
</html>