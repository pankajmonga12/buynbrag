if (!RedactorPlugins) var RedactorPlugins = {};

RedactorPlugins.personalizationtags = {
    init: function ()
    {        
        var dropdown = {};
        
        //Title
        dropdown['title'] = { title: '<strong>Essential personalization tags</strong>'};

		//Essential personalization tags
        dropdown['unsubscribe1'] = { title: "Insert <code>[unsubscribe]</code>", callback: this.unsubscribe1callback };
        dropdown['unsubscribe2'] = { title: 'Insert <code>&lt;unsubscribe&gt;</code>', callback: this.unsubscribe2callback };
        dropdown['webversion1'] = { title: "Insert <code>[webversion]</code>", callback: this.webversion1callback };
        dropdown['webversion2'] = { title: 'Insert <code>&lt;webversion&gt;</code>', callback: this.webversion2callback };
        dropdown['nametag'] = { title: 'Insert <code>[Name,fallback=]</code>', callback: this.nametagcallback };
        dropdown['emailtag'] = { title: 'Insert <code>[Email]</code>', callback: this.emailtagcallback };
        
        //Title
        dropdown['break'] = { title: ''};
        dropdown['title2'] = { title: '<strong>Date personalization tags</strong>'};
        
        //Date personalization tags
        dropdown['currentdaynumber'] = { title: 'Insert <code>[currentdaynumber]</code>', callback: this.currentdaynumbercallback };
        dropdown['currentday'] = { title: 'Insert <code>[currentday]</code>', callback: this.currentdaycallback };
        dropdown['currentmonthnumber'] = { title: 'Insert <code>[currentmonthnumber]</code>', callback: this.currentmonthnumbercallback };
        dropdown['currentmonth'] = { title: 'Insert <code>[currentmonth]</code>', callback: this.currentmonthcallback };
        dropdown['currentyear'] = { title: 'Insert <code>[currentyear]</code>', callback: this.currentyearcallback };

        this.buttonAdd('personalizationtags', 'Personalization Tags', false, dropdown);
    },
    unsubscribe1callback: function(buttonName, buttonDOM, buttonObj, e)
    {
        this.insertHtml("[unsubscribe]");
    },
    unsubscribe2callback: function(buttonName, buttonDOM, buttonObj, e)
    {
        this.insertHtml("<unsubscribe>Unsubscribe here</unsubscribe>");
    },
    webversion1callback: function(buttonName, buttonDOM, buttonObj, e)
    {
        this.insertHtml("[webversion]");
    },
    webversion2callback: function(buttonName, buttonDOM, buttonObj, e)
    {
        this.insertHtml("<webversion>View web version</webversion>");
    },
    nametagcallback: function(buttonName, buttonDOM, buttonObj, e)
    {
        this.insertHtml("[Name,fallback=]");
    },
    emailtagcallback: function(buttonName, buttonDOM, buttonObj, e)
    {
        this.insertHtml("[Email]");
    },
    currentdaynumbercallback: function(buttonName, buttonDOM, buttonObj, e)
    {
        this.insertHtml("[currentdaynumber]");
    },
    currentdaycallback: function(buttonName, buttonDOM, buttonObj, e)
    {
        this.insertHtml("[currentday]");
    },
    currentmonthnumbercallback: function(buttonName, buttonDOM, buttonObj, e)
    {
        this.insertHtml("[currentmonthnumber]");
    },
    currentmonthcallback: function(buttonName, buttonDOM, buttonObj, e)
    {
        this.insertHtml("[currentmonth]");
    },
    currentyearcallback: function(buttonName, buttonDOM, buttonObj, e)
    {
        this.insertHtml("[currentyear]");
    }
};