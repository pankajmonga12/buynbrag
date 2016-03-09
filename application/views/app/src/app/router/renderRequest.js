angular.module('router.renderRequest', [])

.value("RenderContext", function( requestContext, actionPrefix, paramNames ) {

    function getNextSection() {

        return ( requestContext.getNextSection( actionPrefix ) );

    }

    function isChangeLocal() {

        return( requestContext.startsWith( actionPrefix ) );

    }

    function isChangeRelevant() {

        if ( ! requestContext.startsWith( actionPrefix ) ) {

            return( false );

        }

        if ( requestContext.hasActionChanged() ) {

            return( true ) ;

        }

        return(
            paramNames.length && 
            requestContext.haveParamsChanged( paramNames )
        );

    }

    return({
        getNextSection: getNextSection,
        isChangeLocal: isChangeLocal,
        isChangeRelevant: isChangeRelevant
    });

})

.service( "requestContext", function( RenderContext ) {

    function getAction() {
        return( action );
    }

    function getNextSection( prefix ) {

        if ( ! startsWith( prefix ) ) {
            return( null );
        }

        if ( prefix === "" ) {
            return( sections[ 0 ] );
        }

        var depth = prefix.split( "." ).length;

        if ( depth === sections.length ) {
            return( null );
        }

        return( sections[ depth ] );
    }

    function getParam( name, defaultValue ) {

        if ( angular.isUndefined( defaultValue ) ) {
            defaultValue = null;
        }

        return( params[ name ] || defaultValue );
    }

    function getParamAsInt( name, defaultValue ) {

        var valueAsInt = ( this.getParam( name, defaultValue || 0 ) * 1 );

        if ( isNaN( valueAsInt ) ) {
            return( defaultValue || 0 );
        } 
        else {
            return( valueAsInt );
        }

    }
    
    function getRenderContext( requestActionLocation, paramNames ) {

        requestActionLocation = ( requestActionLocation || "" );

        paramNames = ( paramNames || [] );

        if ( ! angular.isArray( paramNames ) ) {
            paramNames = [ paramNames ];
        }

        return(
            new RenderContext( this, requestActionLocation, paramNames )
        );

    }

    function hasActionChanged() {
        return( action !== previousAction );
    }

    function hasParamChanged( paramName, paramValue ) {

        if ( ! angular.isUndefined( paramValue ) ) {
            return( ! isParam( paramName, paramValue ) );
        }

        if ( ! previousParams.hasOwnProperty( paramName ) && params.hasOwnProperty( paramName ) ) {
            return( true );
        } 
        else if ( previousParams.hasOwnProperty( paramName ) && ! params.hasOwnProperty( paramName ) ) {
            return( true );
        }

        return( previousParams[ paramName ] !== params[ paramName ] );
    }

    function haveParamsChanged( paramNames ) {

        for ( var i = 0, length = paramNames.length ; i < length ; i++ ) {

            if ( hasParamChanged( paramNames[ i ] ) ) {
                return( true );
            }

        }

        return( false );
    }

    function isParam( paramName, paramValue ) {

        if ( params.hasOwnProperty( paramName ) && ( params[ paramName ] == paramValue ) ) {
            return( true );
        }

        return( false );
    }

    function setContext( newAction, newRouteParams ) {

        previousAction = action;
        previousParams = params;

        action = newAction;
        sections = action.split( "." );
        params = angular.copy( newRouteParams );
    }

    function startsWith( prefix ) {

        if ( ! prefix.length || ( action === prefix ) || ( action.indexOf( prefix + "." ) === 0 ) ) {
            return( true );
        }

        return( false );
    }

    var action = "";
    var sections = [];
    var params = {};
    var previousAction = "";
    var previousParams = {};

    return({
        getNextSection: getNextSection,
        getParam: getParam,
        getParamAsInt: getParamAsInt,
        getRenderContext: getRenderContext,
        hasActionChanged: hasActionChanged,
        hasParamChanged: hasParamChanged,
        haveParamsChanged: haveParamsChanged,
        isParam: isParam,
        setContext: setContext,
        startsWith: startsWith
    });

});