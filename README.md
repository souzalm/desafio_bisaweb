# desafio_bisaweb

Repositório do teste de uma aplicação para um Sistema de Gestão Financeira do Desafio BisaWeb.

Para a verificação do bom funcionamento da aplicação, pode-se baixar os arquivos do repositório e salva-los em uma pasta na pasta "htdocs" gerada pelo XAMPP. Assim como o APACHE e o MySQL devem estar online.

**Arquivo index.php:**

Arquivo da página inicial da aplicação, nela há dois links, um para o acesso as páginas de gestão das Contas Bancárias e o outro para o acesso as páginas de gestão das Movimentações Financeiras.

**Arquivo user.php:**

Arquivo que contém as informações do host, o nome do banco de dados a ser acessado por essa aplicação, o login e a senha de acesso ao banco de dados o qual a criação consta no arquivo desafio_bisaweb2.sql descrito mais abaixo.

**Arquivo funcoes.php:**

Arquivo que contém algumas funções utilizadas em outros arquivos da aplicação.

**Diretório conta_bancaria:**

Diretório que contém os arquivos .php que defininem a parte da aplicação para gestão das Contas Bancárias.

**Pasta movimentacao_financeira:**

Diretório que contém os arquivos .php que defininem a parte da aplicação para gestão das Movimentações Financeiras.

**Arquivo desafio_bisaweb2.sql:**

Arquivo que contém os passos para a criação do banco de dados "desafio_bisaweb2" utilizado nessa aplicação. A ferramenta MySQL foi utilizada para criação do banco de dados durante o desenvolvimento dessa aplicação, assim como o phpMyAdmin.

**FPDF**

Para geração do Relatório em PDF das Movimentações Financeiras, foi utilizada a class FPDF de PHP que pode ser baixada em http://www.fpdf.org/. Deve-se salvar a pasta descompactada no diretório da aplicação, juntamente com os demais baixados desse repositório. Verificar no arquivo gerarpdf.php no diretório "movimentação_financeira" se o nome do diretório da class FPDF está condizente, conferir a linha 35 do arquivo gerarpdf.php. 
