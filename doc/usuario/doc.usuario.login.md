## USUARIO - LOGIN

### Entidade: USUARIO  
### Ação: LOGIN  
### Método: `POST`  
### Endpoint: `/api`

#### Descrição:
Realiza o login de um usuário no sistema via requisição HTTP.  
Autentica o par `email/senha` informado e, em caso de sucesso, retorna um `sid` (session ID) que deve ser usado nas próximas requisições autenticadas.

#### Parâmetros (JSON no corpo da requisição):

```json
{
  "SysEntidade": "USUARIO",
  "SysEntidadeAcao": "LOGIN",
  "txtLoginEmail": "usuario@mail",
  "txtLoginSenha": "password"
}
```

| Parâmetro         | Tipo     | Obrigatório | Descrição                          |
|-------------------|----------|-------------|------------------------------------|
| SysEntidade        | string   | ✅ Sim      | Nome da entidade (`USUARIO`)       |
| SysEntidadeAcao    | string   | ✅ Sim      | Nome da ação (`LOGIN`)             |
| txtLoginEmail      | string   | ✅ Sim      | E-mail do usuário                  |
| txtLoginSenha      | string   | ✅ Sim      | Senha do usuário                   |

#### Comportamento:

- Envia uma requisição `POST` para o endpoint do sistema.
- Se os dados estiverem corretos, retorna o `sid` da sessão.
- Caso contrário, o sistema retorna erro com código e mensagem apropriada.

#### Exemplo de Requisição:

```bash
POST /api HTTP/1.1
Content-Type: application/json

{
  "SysEntidade": "USUARIO",
  "SysEntidadeAcao": "LOGIN",
  "txtLoginEmail": "supervisor@supervisor",
  "txtLoginSenha": "supervisor"
}
```

#### Exemplo de Resposta (Sucesso):
```json
{
  "sid": "f964259434fc82886b0d95a18f0d4893"
}
```

#### Observações:

- O `sid` retornado deve ser armazenado no app cliente e enviado em todas as próximas requisições autenticadas.
- Requisições sem `sid` válido serão rejeitadas.
- A autenticação pode falhar caso os dados estejam incorretos ou o usuário esteja inativo.
