function valida_formulario(form) {

			if (form.nome.value == '') {
				alert('Preencha o Nome');
				form.nome.focus();
				return false;
			}
			else if(form.cpf.value==''){
				alert('Preencha o seu cpf');
				form.cpf.focus();
				return false;
			}
			else if(form.data.value==''){
				alert('Preencha a sua data');
				form.cpf.focus();
				return false;
			}
			else if(form.email.value==''){
				alert('Preencha o seu email');
				form.cpf.focus();
				return false;
			}
			else if(form.tel.value==''){
				alert('Preencha o telefone');
				form.cpf.focus();
				return false;
			}
			else if (form.msg.value==''){
				alert('A mensagem não pode ser vazia.');
				form.msg.focus();
				return false;
			}
			
			alert('Seu contato foi enviado com sucesso!');
			return true;
		
			
		}
