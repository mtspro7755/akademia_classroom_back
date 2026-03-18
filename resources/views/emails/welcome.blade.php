<!DOCTYPE html>
<html>
    <head>
        <title>Bienvenue</title>
    </head>
    <body style="font-family: Arial, sans-serif; line-height: 1.6;">
        <h2>Bonjour {{ $apprenant->nomComplet }},</h2>
        <p>Nous sommes ravis de vous accueillir sur <strong>Akademia Classroom</strong> !</p>
        <p>Votre compte a été créé avec succès avec le pseudo : <strong>{{ $apprenant->pseudo }}</strong>.</p>
        <p>Vous pouvez maintenant vous connecter et commencer vos quêtes.</p>
        <br>
        <p>L'équipe Akademia.</p>
    </body>
</html>
