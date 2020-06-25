# CodFlix project

## Some details

I use the same controller for the detail of the media and the list of the media because there are a lot in common, but
could be two separates controller too.

## Important

To test the confirmation link, you can uncomment this line in loginController:

`$error_msg = "Votre compte n'est pas activé, le lien devrait être localhost/CodFlix/index.php?action=login&confirmation=" . $userData['email'] . ':' . $userData['key'];`

This will show the confirmation link for the account you try to connect with if it is not activated.



## Setup

### Run
1. You have to use a local server such as Wamp or Mamp
1. Import the database `codflix.sql`
1. Pull the repo in the `www/` directory of your local server
1. Follow the address of your repo. For example, if your repo is in ``www/codflix/``, the URL should be http://localhost/codflix or http://127.0.0.1/codflix

Nothing else is required. You can now start your development

