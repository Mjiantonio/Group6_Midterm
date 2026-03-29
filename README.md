Database.php
This is basically the bridge that lets my PHP code talk to the PostgreSQL database, 
tis uses PDO to log in with the credentials, and if I mess up the password, 
the whole system will probably just catch on fire and die.

Event.php
handles all the logic for the event names and addresses
and I even threw in that Analytic qery to find which event is the most popular

Participant.php
handle the people actually attending the events which maps right to our participants table.

Registration.php
eto yung glue. d jk pero ginagawa nya is nililink nya yung participant IDs sa event IDs para mabilang yung total registration
