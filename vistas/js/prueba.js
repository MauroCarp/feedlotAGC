
const data = new FormData();
data.append('empresa', 'DesarrolloWeb.com');
data.append('CIF', 'ESB00001111');
data.append('formacion_profesional', 'EscuelaIT');
fetch('../post.php', {
   method: 'POST',
   body: data
})