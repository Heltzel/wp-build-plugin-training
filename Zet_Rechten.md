📂 Concreet
1. Open .bashrc:
nano ~/.bashrc

2. Voeg onderaan toe:
# UID en GID voor Docker containers
export DOCKER_UID=$(id -u)
export DOCKER_GID=$(id -g)

3. Herlaad .bashrc:
source ~/.bashrc

4. Controleer:
echo $DOCKER_UID $DOCKER_GID


Je zou iets zien zoals:

1000 1000

🐳 5. Pas je docker-compose.yml aan

In de wp service vervang je:`

``` yml

user: "${UID}:${GID}"

```

door:

user: "${DOCKER_UID}:${DOCKER_GID}"


(en eventueel ook bij wpcli als je wilt dat die ook als jouw gebruiker draait).

🔁 6. Herstart Docker Compose
docker compose down
docker compose up -d


👉 Nu worden bestanden netjes aangemaakt als jouw gebruiker, en je krijgt geen fout meer in .bashrc.
Geen chown-gedoe meer bij elke opstart 🚀