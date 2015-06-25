<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Prismic.io Javascript INDEX TEST</title>
    <!-- Mocha and Chai -->
    <!-- <link rel="stylesheet" href="../node_modules/mocha/mocha.css"> -->
    
   <script src="../js/vendor/jquery-2.1.1.min.js"></script>
   <script src="../js/vendor/prismic.io.js"></script>  
   <!-- <script type="text/javascript" src="//static.cdn.prismic.io/prismic.min.js"></script> -->
   <script type="text/javascript" src="//static.cdn.prismic.io/prismic.min.js"></script> 
    
</head>
<body>
<div id="mocha"></div>

<p>Hi!</p>
<!-- <script src="../node_modules/chai/chai.js"></script>
<script src="../node_modules/mocha/mocha.js"></script> 
<script>mocha.setup('bdd')</script>  -->
<!-- Load local lib and tests. -->

<!--
<script src="../src/api.js"></script>
<script src="../src/lru.js"></script>
<script src="../src/cache.js"></script>
<script src="../src/utils.js"></script>
<script src="../src/documents.js"></script>
<script src="../src/fragments.js"></script>
<script src="../src/predicates.js"></script>
<script src="../src/experiments.js"></script>
<script src="./doc.js"></script>
-->


<script src="../src/api.js"></script>
<script src="../src/lru.js"></script>
<script src="../src/cache.js"></script>
<script src="../src/utils.js"></script>
<script src="../src/documents.js"></script>
<script src="../src/fragments.js"></script>
<script src="../src/predicates.js"></script>
<script src="../src/experiments.js"></script>
<!-- <script src="./doc.js"></script> -->






<!--- <script>
    if (window.mochaPhantomJS) {
        mochaPhantomJS.run();
    } else {
        mocha.run();
    }
</script> -->





<!--- start --->


<p id="demo"></p>


 <script>
     
 
/*
 // Prismic.Api('https://lesbonneschoses.prismic.io/api', function (err, Api) {
  Prismic.Api('https://lesbonneschoses-vqp1iiuaacaalqz4.prismic.io/api', function (err, Api) {
    // You can use the Api object inside this block
    console.log("References: ", Api.data.refs);
});



*/

//var previewToken = 'MC5VbDdXQmtuTTB6Z0hNWHF3.c--_vVbvv73v';

Prismic.Api('https://lesbonneschoses-vqp1iiuaacaalqz4.prismic.io/api', function (err, Api) {
  //var stPatrickRef = Api.ref("St-Patrick specials"); 
  var tester=  Api.form('everything')
        .ref(Api.master()) // .ref(stPatrickRef) 
       // The master reference exists for all repositories, and corresponds to the documents that are live now
      // The other references are for any upcoming release your writers have created 
      //Note that by default only the master reference is public and accessible without a token, to retrieve future releases you will likely need an access token.
//            
            // "at" predicate: equality of a fragment to a value.
            
 //var Predicates = Prismic.Predicates
 // var dateBefore = Predicates.dateBefore("my.product.releaseDate", new Date(2014, 6, 1));
            
        .query(Prismic.Predicates.at("document.type", "blog-post")//, //"product" "blog-post" "article"
      //  Prismic.Predicates.dateAfter("my.product.releaseDate", new Date(1998, 6, 1))  // my.product.price desc
                               //my.product.releaseDate, my.blog-post.date, 
                               /// there is no product.date
                  ///releaseDate date is still questionable...
                  //
                  //
                         // .dateBefore .dateAfter .dateBetween .dayOfMonth .dayOfMonthAfter .dayOfMonthBefore
// .dayOfWeek .dayOfWeekAfter .dayOfWeekBefore .month .monthBefore .year .hour .hourBefore


/// "any" predicate: equality of a fragment to a value.
//var any = Predicates.any("document.type", ["article", "blog-post"]);

// "fulltext" predicate: fulltext search in a fragment.
//var fulltext = Predicates.fulltext("my.article.body", "sausage");

// "similar" predicate, with a document id as reference
//var similar = Predicates.similar("UXasdFwe42D", 10);                        
                               
                               
        )
        .pageSize(100)
        .orderings('[my.product.price desc]') //my.blog-post.date, my.product.price

//page: the number of the page. By default, the first page (1) will be returned.
//pageSize: the number of document per page. By default, 20 documents will be returned per page.
//orderings: how you want the results to be ordered. See the API Documentation for more details about this field.





//FRAGMENTS
/*
 * 
 * 
var author = doc.getText("blog-post.author");
if (!author) author = "Anonymous";

// Number predicates
val gt = Predicate.gt("my.product.price", 10)
val lt = Predicate.lt("my.product.price", 20)
val inRange = Predicate.inRange("my.product.price", 10, 20)

// Accessing number fields
val price = doc.getNumber("product.price")

var bgcolor = doc.getColor("article.background");
$("#article").css("background-color", bgcolor)

// Accessing Date and Timestamp fields
var date = doc.getDate("blog-post.date");
var resultYear = date ? date.getFullYear() : null;
var updateTime = doc.getTimestamp("blog-post.update");
var updateHour = updateTime ? updateTime.getHours() : 0;
*/



        
        .submit(function (err, response) {
            // The documents object contains a Response object with all documents of type "product".
            var page = response.page; // The current page number, the first one being 1
            var results = response.results; // An array containing the results of the current page;
            // you may need to retrieve more pages to get all results
            var prev_page = response.prev_page; // the URL of the previous page (may be null)
            var next_page = response.next_page; // the URL of the next page (may be null)
            var results_per_page = response.results_per_page; // max number of results per page
            var results_size = response.results_size; // the size of the current page
            var total_pages = response.total_pages; // the number of pages
            var total_results_size = response.total_results_size; // the total size of results across all pages
            var docz = response.results[0];
             ///PREDICATES can be placed here... TAKE NOTE!!
            
             // Accessing image fields
           // var image = docz.getImage("product.image");
             // Most of the time you will be using the "main" view
          //   var url = image.main.url;      
          
          ////Most of the time, you will want to generate an HTML representation from the StructuredTest. This is done with the asHtml() method (or as_html() in some languages). 
//          var doc = response.results[0];
//          var html = doc.getStructuredText('blog-post.body').asHtml({
//            linkResolver: function (ctx, doc, isBroken) {
//           if (isBroken) return '#broken';
//             return "/testing_url/" + doc.id + "/" + doc.slug + ( ctx.maybeRef ? '?ref=' + ctx.maybeRef : '' );
//           }
//           });
//           ////you need to pass a LinkResolver to the asHtml method. This is necessary for hypertext links to other documents: because Prismic doesn't know anything about your front-end, you need to tell him how to build a URL to a Prismic document on your site. The starter kits provide an implementation that relies on the framework's router, but if you want a different URL pattern you will have to adapt it.
//          
            
         //=============
//         /In addition to the LinkResolver, you can pass an optional HtmlSerializer to the asHtml method. You don't have to write the HTML serialization for all the possible types, just the ones you want to override the default behavior.
//            var htmlSerializer = function (element, content) {
//  // Don't wrap images in a <p> tag
//  if (element.type == "image") {
//    return '<img src="' + element.url + '" alt="' + element.alt + '">';
//  }
//
//  // Add a class to hyperlinks
//  if (element.type == "hyperlink") {
//    return '<a class="some-link" href="' + element.url + '">' + content + '</a>';
//  }
//
//  // Return null to stick with the default behavior
//  return null;
//};
//var html = doc.getStructuredText('blog-post.body').asHtml(getLinkResolver(), htmlSerializer);
//
//
//
//            
        //=======================    
//        Link fragments
//        
//
//    WebLink: a link to a URL, either external to your site or not managed by Prismic.io
//    DocumentLink: a link to a document within you Prismic.io repository
//    MediaLink: a link to a medium (image, video) from your Prismic.io gallery

//        
//        
//        
//        var resolver = function (ctx, doc, isBroken) {
//            if (isBroken) return '#broken';
//            return "/testing_url/" + doc.id + "/" + doc.slug + ( ctx.maybeRef ? '?ref=' + ctx.maybeRef : '' );
//          };
//          var source = doc.getLink("article.source");
//          var url = source ? source.url(resolver) : null;

//===================
//
// embed a video
 //var video = doc.get("article.video");
 // Html is the code to include to embed the object, and depends on the embedded service
 //var html = video ? video.asHtml() : "";
 //=======
 //
 // Geopoint Fragments
        // "near" predicate for GeoPoint fragments
//       var near = Predicates.near("my.store.location", 48.8768767, 2.3338802, 10);
//
//       // Accessing GeoPoint fragments
//       var place = doc.getGeoPoint("article.location");
//       var coordinates;
//       if (place) {
//         coordinates = place.latitude + "," + place.longitude;
//       }

///========================

            if (err) {
                console.log(err);
                done();
               }  
               
               if (response.results_size>0) {
                    console.log("tester: ", response.results[0]["slugs"][0]);
                    console.log("tester: ", results[0]["slugs"][0]);
                    console.log("tester: ", results); 
                     document.getElementById("demo").innerHTML = response.results[1]["slugs"][0];
                 }     
                
        });
        
        
});





</script>
  <script src="//static.cdn.prismic.io/prismic.js"></script> 
<!--- end --->

</body>
</html>
