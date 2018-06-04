#base image of tomcat
FROM tomcat:8.0

MAINTAINER kumar Ankit

ARG warfile

RUN echo $warfile

#Adding war to container
ADD $warfile +'.war' /opt/

#extracting war file
RUN jar xvf /opt/$warfile +'.war' 

#copy app to webapps
COPY $warfile /usr/local/tomcat/webapps
