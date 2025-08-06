FROM node:22

# Definir diretório de trabalho
WORKDIR /var/www

# Copia os arquivos de dependência
COPY src/frontend/package*.json ./

# Instalar as dependências do npm
RUN npm install

# Copia o restante do código
COPY src/frontend/. ./

# Expor a porta para desenvolvimento, caso necessário
EXPOSE 5173

# Comando para rodar o servidor de desenvolvimento do Vite (apenas para desenvolvimento)
CMD ["npm", "run", "dev"]