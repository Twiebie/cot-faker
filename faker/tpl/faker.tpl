<!-- BEGIN: MAIN -->
{FILE "{PHP.cfg.themes_dir}/{PHP.cfg.defaulttheme}/warnings.tpl"}
<!-- BEGIN: FORM -->
<form action="{FKR_PAGE_ACTION}" method="post" role="form">
  <h3>{PHP.L.Pages}</h3>
  <table class="cells">
    <tr>
      <td>{PHP.L.fkr_page_category}</td>
      <td>{FKR_PAGE_CAT}</td>
    </tr>
    <tr>
      <td>{PHP.L.fkr_page_amount}</td>
      <td>{FKR_PAGE_AMOUNT}</td>
    </tr>
    <tr>
      <td>{PHP.L.fkr_page_max_title}</td>
      <td>{FKR_PAGE_MAX_TITLE}</td>
    </tr>
    <tr>
      <td>{PHP.L.fkr_page_max_chars}</td>
      <td>{FKR_PAGE_MAX_CHARS}</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
        <button type="submit" class="btn">{PHP.L.fkr_generate}</button>
      </td>
    </tr>
  </table>
</form>

<form action="{FKR_USER_ACTION}" method="post" role="form">
  <h3>{PHP.L.Users}</h3>
  <table class="cells">
    <tr>
      <td>{PHP.L.fkr_user_amount}</td>
      <td>{FKR_USER_AMOUNT}</td>
    </tr>
    <tr>
      <td>{PHP.L.fkr_user_group}</td>
      <td>{FKR_USER_GROUP}</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
        <button type="submit" class="btn">{PHP.L.fkr_generate}</button>
      </td>
    </tr>
  </table>
</form>
<!-- END: FORM -->
<!-- END: MAIN -->
