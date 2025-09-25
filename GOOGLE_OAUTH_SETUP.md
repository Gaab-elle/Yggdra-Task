# 🔧 Configuração do Google OAuth - TaskForce

## Erro Atual
- **Erro 400**: "invalid_client" - Cliente OAuth não encontrado
- **URL do erro**: `accounts.google.com/signin/oauth/error?authError=Cg5pbnZhbGlkX2NsaWVudA...`

## Solução Passo a Passo

### 1. Acesse o Google Cloud Console
- Vá para: https://console.cloud.google.com/
- Faça login com sua conta Google

### 2. Criar/Selecionar Projeto
- Clique em "Selecionar projeto" no topo
- Clique em "NOVO PROJETO"
- Nome: "TaskForce App"
- Clique em "CRIAR"

### 3. Ativar APIs Necessárias
- No menu lateral, vá em "APIs e serviços" > "Biblioteca"
- Procure por "Google+ API" ou "Google Identity"
- Clique em "ATIVAR"

### 4. Configurar OAuth 2.0
- Vá em "APIs e serviços" > "Credenciais"
- Clique em "CRIAR CREDENCIAIS" > "ID do cliente OAuth 2.0"
- Tipo de aplicativo: "Aplicativo da Web"
- Nome: "TaskForce App"

### 5. Configurar URIs de Redirecionamento
- **URIs de redirecionamento autorizados**:
  ```
  http://localhost:8000/auth/google/callback
  http://127.0.0.1:8000/auth/google/callback
  ```
- Clique em "CRIAR"

### 6. Copiar Credenciais
Após criar, você receberá:
- **Client ID**: `xxxxxxxxx.apps.googleusercontent.com`
- **Client Secret**: `GOCSPX-xxxxxxxxx`

### 7. Atualizar arquivo .env
Substitua as linhas no arquivo `.env`:
```env
GOOGLE_CLIENT_ID=seu_client_id_aqui
GOOGLE_CLIENT_SECRET=seu_client_secret_aqui
GOOGLE_REDIRECT=http://localhost:8000/auth/google/callback
```

### 8. Testar
- Execute: `php artisan serve`
- Acesse: `http://localhost:8000/auth/google`

## Verificação Adicional

### Se ainda não funcionar:
1. **Verificar domínio autorizado**:
   - No Google Cloud Console > Credenciais
   - Editar o OAuth 2.0
   - Adicionar em "Domínios autorizados": `localhost`

2. **Verificar se a API está ativada**:
   - Google+ API ou Google Identity API deve estar ativa

3. **Limpar cache do Laravel**:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

## URLs Importantes
- **Google Cloud Console**: https://console.cloud.google.com/
- **Documentação OAuth**: https://developers.google.com/identity/protocols/oauth2
- **Laravel Socialite**: https://laravel.com/docs/socialite
