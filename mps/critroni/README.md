# Critroni-Simulation
This project is mainly taken from eyecatchup/Critroni-php but includes some fix so that you can add it to your web server if you need to simulate a web-server ransomware attack. This is based on CTB-Locker/Critroni/Onion Ransomware

# Trigger
Web-server account would first require write permission.

In order to trigger the encryption, send a POST request to the site.

Values required are as follows:

submit="AES-256 ECB key"

submit2="AES-256 ECB key"

Vice-Versa to decrypt:

reverse="AES-256 ECB key"

reverse2="AES-256 ECB key"

# Disclaimer
Becareful when using this and make sure you understand how the code works. I take no responsibility for any damage caused.
