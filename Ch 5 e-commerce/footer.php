<?php # Script 5.3 - footer.html

// Close the database connection.
if (isset($dbc)) {
    mysqli_close($dbc);
    unset($dbc);
}
?>
</div>
<div class="clearfix"></div>
<div class="footer">&copy; 2005, design by <a href="http://www.now-design.co.uk/">NOW:design</a> |
    Template from <a href="http://www.oswd.org/">oswd.org</a></div>
</div>
</div>

</body>
</html>
