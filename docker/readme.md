TODO clean up this readme

Install docker-machine: http://sa.muel.be/2015/run-docker-on-hyper-v-with-docker-machine/

docker-machine ssh docker -- "sudo mkdir /mnt/www && sudo mount -t cifs -o sec=ntlm,username=docker,pass=docker,file_mode=0777,dir_mode=0777,noperm  //192.168.137.1/www /mnt/www"

# mount folder from windows host to linux guest
sudo mkdir /mnt/www && sudo mount -t cifs -o sec=ntlm,username=docker,pass=docker,file_mode=0777,dir_mode=0777,noperm  //192.168.137.1/www /mnt/www

# build the container via a Dockerfile
docker build -t="loo" /mnt/www/loo/docker

# run container and keep running
docker run -d -p 80:80 -p 9000:9000 -p 2222:22 -p 5432:5432 -p 6379:6379  -p 1337:1337 -v /mnt/www/loo:/var/www/loo loo

# attach to the running container
docker attach c5454dcfeb1d

docker exec -it happy_wozniak bash

# how to get the host ip
/sbin/ip route|awk '/default/ { print $3 }'

# remove unused
docker rmi $(docker images | grep "^<none>" | awk "{print $3}")
