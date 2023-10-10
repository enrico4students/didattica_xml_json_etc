<jsp:useBean id="time" class="CurrentTimeBean"/>
<html>
<body>
<p>Sono le ore
<jsp:getProperty name="time" property="hours"/> e
<jsp:getProperty name="time" property="minutes"/> minuti.
</p>
</body>
</html>