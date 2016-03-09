angular.module("services.seo", [])
.factory("seo", [function() {

	var seoMetaTags = {};

	seoMetaTags.title = "Home Furniture Store: Buy Furniture Online, Home Decor, Arts in India";
	seoMetaTags.description = "Online Furniture Store – Buy furniture, Home decor, Furnishing, Lighting, Arts online to suit every class, budget at BuynBrag.com. We deliver everything on your wish list.";
	seoMetaTags.ogType = "website";
	seoMetaTags.image = "http://buynbrag.com/application/views/dist/images/bnb_logo_200.png";
	seoMetaTags.imageType = "image/png";
	seoMetaTags.imageWidth = "512";
	seoMetaTags.imageHeight = "200";

	return seoMetaTags;

}])