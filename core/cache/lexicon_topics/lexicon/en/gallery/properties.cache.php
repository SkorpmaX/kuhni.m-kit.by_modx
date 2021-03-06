<?php  return array (
  'gallery.activecls_desc' => 'The CSS class to add when the active item (the item specified in the GalleryItem snippet) is displayed.',
  'gallery.album_desc' => 'Will load only items from this album. Can be either the name or ID of the Album.',
  'gallery.albumrequestvar_desc' => 'If checkForRequestAlbumVar is set to true, will look for a REQUEST var with this name to select the album.',
  'gallery.checkforrequestalbumvar_desc' => 'If 1, if a REQUEST var of "album" is found, will use that as the album property for the snippet.',
  'gallery.checkforrequesttagvar_desc' => 'If 1, if a REQUEST var of "tag" is found, will use that as the tag property for the snippet.',
  'gallery.containertpl_desc' => 'An optional chunk to wrap the output in.',
  'gallery.dir_desc' => 'The direction to sort images by.',
  'gallery.imagefar_desc' => 'The "far" value for phpThumb for the image, for aspect ratio zooming.',
  'gallery.imageheight_desc' => 'If being used by a plugin, the height of the currently on-display image.',
  'gallery.imagegetparam_desc' => 'The GET param to use when not linking directly to an image. Make sure this matches the getParam property in the GalleryItem snippet call.',
  'gallery.imageproperties_desc' => 'A JSON object of parameters to pass to phpThumb as properties for the image.',
  'gallery.imagequality_desc' => 'The "q" value for phpThumb for the image, for quality.',
  'gallery.imagewidth_desc' => 'If being used by a plugin, the width of the currently on-display image.',
  'gallery.imagezoomcrop_desc' => 'If being used by a plugin, whether or not the currently on-display image will be zoom-cropped.',
  'gallery.itemcls_desc' => 'The CSS class for each thumbnail.',
  'gallery.limit_desc' => 'If set to non-zero, will only show X number of items.',
  'gallery.linktoimage_desc' => 'If true, will link directly to the image. If false, will append GET parameters to the URL to load the image with the GalleryItem snippet.',
  'gallery.plugin_desc' => 'The name of a plugin to use for front-end displaying. Please see the official docs for a list of available plugins.',
  'gallery.pluginpath_desc' => 'Could not load plugin "[[+name]]" from path: [[+path]]',
  'gallery.showinactive_desc' => 'If 1, will also display inactive images.',
  'gallery.sort_desc' => 'The field to sort images by.',
  'gallery.start_desc' => 'The index to start grabbing from when limiting the number of items. Similar to an SQL order by start clause.',
  'gallery.tag_desc' => 'Will load only items with this tag.',
  'gallery.tagrequestvar_desc' => 'If checkForRequestTagVar is set to true, will look for a REQUEST var with this name to select the tag.',
  'gallery.toplaceholder_desc' => 'If set, will set the output to a placeholder of this value, and the snippet call will output nothing.',
  'gallery.thumbfar_desc' => 'The "far" value for phpThumb for the thumbnail, for aspect ratio zooming.',
  'gallery.thumbheight_desc' => 'The height of the generated thumbnails, in pixels.',
  'gallery.thumbproperties_desc' => 'A JSON object of parameters to pass to phpThumb as properties for the thumbnail.',
  'gallery.thumbquality_desc' => 'The "q" value for phpThumb for the thumbnail, for quality.',
  'gallery.thumbtpl_desc' => 'The Chunk to use as a tpl for each thumbnail.',
  'gallery.thumbwidth_desc' => 'The width of the generated thumbnails, in pixels.',
  'gallery.thumbzoomcrop_desc' => 'Whether or not the thumbnail will be zoom-cropped.',
  'gallery.usecss_desc' => 'Whether or not to use the pre-provided CSS for the snippet.',
  'galleryalbums.albumrequestvar_desc' => 'If checkForRequestAlbumVar is set to true, will look for a REQUEST var with this name to select the album.',
  'galleryalbums.albumcoversort_desc' => 'The field which to use when sorting to get the Album Cover. To get the first image, use "rank". To get a random image, use "random".',
  'galleryalbums.albumcoversortdir_desc' => 'The direction to use when sorting to get the Album Cover. Accepts "ASC" or "DESC".',
  'galleryalbums.dir_desc' => 'The direction to sort the results by.',
  'galleryalbums.limit_desc' => 'If set to non-zero, will limit the number of results returned.',
  'galleryalbums.parent_desc' => 'Grab only the albums with a parent album with this ID.',
  'galleryalbums.prominentonly_desc' => 'If 1, will only display albums marked with a "prominent" status.',
  'galleryalbums.rowcls_desc' => 'A CSS class to be added to each album row.',
  'galleryalbums.rowtpl_desc' => 'The Chunk to use for each album row.',
  'galleryalbums.showall_desc' => 'If 0, will hide the album name in the album row tpl.',
  'galleryalbums.showinactive_desc' => 'If 1, will show inactive galleries as well.',
  'galleryalbums.start_desc' => 'The index to start from in the results.',
  'galleryalbums.sort_desc' => 'The field to sort the results by.',
  'galleryalbums.thumbfar_desc' => 'The "far" value for phpThumb for the album cover thumbnail, for aspect ratio zooming.',
  'galleryalbums.thumbheight_desc' => 'The height of the generated album cover thumbnail, in pixels.',
  'galleryalbums.thumbproperties_desc' => 'A JSON object of parameters to pass to phpThumb as properties for the album thumbnail.',
  'galleryalbums.thumbquality_desc' => 'The "q" value for phpThumb for the album cover thumbnail, for quality.',
  'galleryalbums.thumbwidth_desc' => 'The width of the generated album cover thumbnail, in pixels.',
  'galleryalbums.thumbzoomcrop_desc' => 'Whether or not the album coverthumbnail will be zoom-cropped.',
  'galleryalbums.toplaceholder_desc' => 'If not empty, will set the output to a placeholder with this value.',
  'galleryitem.albumrequestvar_desc' => 'The REQUEST var to use when linking albums.',
  'galleryitem.albumseparator_desc' => 'A string separator for each album listed for the Item.',
  'galleryitem.albumtpl_desc' => 'Name of a chunk to use for each album that is listed for the Item.',
  'galleryitem.id_desc' => 'The ID of the item to display.',
  'galleryitem.imagefar_desc' => 'The "far" value for phpThumb for the image, for aspect ratio zooming.',
  'galleryitem.imageheight_desc' => 'If being used by a plugin, the max height of the generated image.',
  'galleryitem.imageproperties_desc' => 'A JSON object of parameters to pass to phpThumb as properties for the generated image.',
  'galleryitem.imagequality_desc' => 'The "q" value for phpThumb for the image, for quality.',
  'galleryitem.imagewidth_desc' => 'If being used by a plugin, the max width of the generated image.',
  'galleryitem.imagezoomcrop_desc' => 'Whether or not to use zoom cropping for the image.',
  'galleryitem.tagrequestvar_desc' => 'The REQUEST var to use when linking tags.',
  'galleryitem.tagseparator_desc' => 'A string separator for each tag listed for the Item.',
  'galleryitem.tagsortdir_desc' => 'A the direction to sort the tags listed for the Item.',
  'galleryitem.tagtpl_desc' => 'Name of a chunk to use for each tag that is listed for the Item.',
  'galleryitem.toplaceholders_desc' => 'If true, will set the properties of the Item to placeholders. If false, will use the tpl property to output a chunk.',
  'galleryitem.toplaceholdersprefix_desc' => 'Optional. The prefix to add to placeholders set by this snippet. Only works if toPlaceholders is true.',
  'galleryitem.tpl_desc' => 'Name of a chunk to use when toPlaceholders is set to false.',
  'galleryitem.thumbfar_desc' => 'The "far" value for phpThumb for the thumbnail, for aspect ratio zooming.',
  'galleryitem.thumbheight_desc' => 'The max height of the generated thumbnail, in pixels.',
  'galleryitem.thumbproperties_desc' => 'A JSON object of parameters to pass to phpThumb as properties for the thumbnail.',
  'galleryitem.thumbquality_desc' => 'The "q" value for phpThumb for the thumbnail, for quality.',
  'galleryitem.thumbwidth_desc' => 'The max width of the generated thumbnail, in pixels.',
  'galleryitem.thumbzoomcrop_desc' => 'Whether or not to use zoom cropping for the thumbnail.',
);