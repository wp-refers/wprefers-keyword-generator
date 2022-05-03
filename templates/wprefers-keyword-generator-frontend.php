<style>
    .wprefers-keyword-generator-wrapper table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    .wprefers-keyword-generator-wrapper td.wphg-title {
        font-weight: bold;
    }

    .wprefers-keyword-generator-wrapper .wprefers-error {
        color: red;
    }

    .wprefers-keyword-generator-wrapper button.wphg-btn-cp-clipboard {
        float: right;
        cursor: pointer;
    }

    .wprefers-keyword-generator-wrapper button.wphg-btn-generate {
        float: right;
        cursor: pointer;
    }

    .wprefers-keyword-generator-wrapper td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    .wprefers-keyword-generator-wrapper .wprefers-keyword-generator-query {
        margin-top: 5px;
        margin-bottom: 5px;
    }
    .wprefers-keyword-generator-wrapper textarea {
        width: 100%;
    }
    .wprefers-keyword-generator-wrapper input {
        width: 100%;
    }
    .wprefers-keyword-generator-wrapper select {
        width: 80%;
        margin-top: 5px;
        margin-bottom: 5px;
    }
    .wprefers-keyword-generator-wrapper ul {
        margin: 0;
        padding: 0;
    }
    .wprefers-keyword-generator-wrapper .wprefers-keyword-generator-total-keywords {
        font-weight: bold;
        cursor: pointer;
        float: right;
    }
    .wprefers-keyword-generator-wrapper .wprefers-keyword-generator-total-keywords-selected {
        font-weight: bold;
        cursor: pointer;
        float: right;
    }
    .wprefers-keyword-generator-wrapper li {
        list-style:none;
        float:left;
        padding: 5px 10px;
        border: 1px solid #eee;
        width: 100%;
        cursor: pointer;
    }

    .wprefers-keyword-generator-wrapper li.selected {
        font-weight: bold;
    }
</style>
<div class="wprefers-keyword-generator-wrapper">
    <div class="wprefers-keyword-generator-query">
        <input type="text" name="wprefers-keyword" placeholder="Enter your keyword">
        <select name="wprefers-country" id="wprefers-country">
            <optgroup label="North america">
                <option value="us-en">United States</option>
                <option value="ca-en">Canada</option>
            </optgroup>
            <optgroup label="Europe">
                <option value="uk-en">United Kingdom</option>
                <option value="nl-nl">Netherlands</option>
                <option value="be-fr">Belgium (FR)</option>
                <option value="be-nl">Belgium (NL)</option>
                <option value="de-de">Germany</option>
                <option value="fr-fr">France</option>
                <option value="dk-dk">Denmark</option>
                <option value="ie-ie">Ireland</option>
                <option value="it-it">Italy</option>
                <option value="es-es">Spain</option>
                <option value="pt-pt">Portugal</option>
            </optgroup>
            <optgroup label="Other">
                <option value="au-en">Australia</option>
                <option value="nz-en">New Zealand (EN)</option>
            </optgroup>
        </select>

        <button id="wprefers-generator">Generate</button>
    </div>

    <div class="wprefers-keyword-generator-response">
        <table>
            <tr>
                <th style="width: 70%;">
                    Keyword <small>Select the below list</small>

                    <span class="wprefers-keyword-generator-total-keywords" title="Total keywords Found">0</span>
                </th>
                <th>Selected</th>
            </tr>
            <tr>
                <td>
                    <ul style="height: 278px;overflow: auto;">
                        <li>No Keywords!</li>
                    </ul>
                </td>
                <td>
                    <textarea name="selected-keywords" id="wprefers-selected-keywords" cols="30" rows="10"></textarea>
                    <br>
                    <button class="wprefers-keyword-generator-btn-cp-clipboard">Copy</button>
                    <button class="wprefers-keyword-generator-btn-clear">Clear</button>
                    <span class="wprefers-keyword-generator-total-keywords-selected" title="Total keywords Selected">0</span>
                </td>
            </tr>
        </table>
    </div>
</div>