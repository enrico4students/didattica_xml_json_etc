<%@ page import="java.io.*" %>
<%@ page import="java.util.*" %>
<%@ page language="java" %>
<%! int giorno=0;%>
<%! int mese=0;%>
<%! int anno=0;%>
<% Date data = new Date();%>
<% giorno=data.getDate();%>
<% mese=data.getMonth()+1;%>
<% anno=data.getYear();%>
<% if(anno<1900) anno=anno+1900;
   out.println("Data corrente :"+giorno+"/"+mese+"/"+anno);
%>