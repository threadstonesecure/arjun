This is the README.md file

To use the docker file run the below commands in the folder where you have thw docker file and the war file.

1.	docker build -t <image tag name> --build-arg warfile=<war file name> <directory where Dockerfile is present>
	eg: docker build -t ankitech/tomcat:1.0 --build-arg warfile=sample .

2.	docker run -it --rm -d -p <host port name>:8080 <image tag name>
	eg: docker run -it --rm -d -p 8888:8080 ankitech/tomcat:1.0
