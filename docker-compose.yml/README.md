## دستورات و کامند ها

```bash

نصب داکر
اشغال بخشی از حافظه سیستم برای n8n
docker volume create n8n_data
و پس از اون اجرای دستور 
docker run -it --rm --name n8n -p 5678:5678 -v n8n_data:/home/node/.n8n docker.n8n.io/n8nio/n8n


```