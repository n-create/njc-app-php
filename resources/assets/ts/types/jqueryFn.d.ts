interface JQuery {
  galleriffic(options: any): any;
  __loading(): any;
  baseDivCreate(options: any): any;
  loadingImg(options: any): any;
  colorbox(options: any): any;
  slick(options: any): any;
}

interface JQueryStatic {
  mapSearch(options: any): {
    base(): void;
    preInit(): void;
    codeAddressFreeword(mapGeoCode: any, searchMapMarker: any): void;
  };
  mapSearchBase(): {
    base(): void;
    preInit(): void;
    codeAddressFreeword(mapGeoCode: any, searchMapMarker: any): void;
  };
}
