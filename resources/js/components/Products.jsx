import React, { useState } from "react";
import { makeStyles } from "@material-ui/core/styles";
import GridList from "@material-ui/core/GridList";
import GridListTile from "@material-ui/core/GridListTile";
import GridListTileBar from "@material-ui/core/GridListTileBar";
import IconButton from "@material-ui/core/IconButton";
import FeaturedVideoTwoToneIcon from "@material-ui/icons/FeaturedVideoTwoTone";
import ProductVideoPreview from "./ProductVideoPreview";

const useStyles = makeStyles((theme) => ({
  root: {
    display: "flex",
    flexWrap: "wrap",
    justifyContent: "space-around",
    overflow: "hidden",
    backgroundColor: theme.palette.background.paper,
    marginrTop: "10px",
  },
  gridList: {
    width: "65em",
    height: "auto",
  },
  info: {
    textAlign: "left",
    fontSize: "small",
    fontWeight: "lighter",
  },
  thumbnail: {
    borderRadius: "8px",
    objectFit: "cover",
  },
  icon: {
    color: "rgba(255, 255, 255, 0.54)",
  },
  priceTag: {
    fontWeight: "bolder",
  },
}));

export default function Products({ catalogData, currentPage, gender }) {
  const [isProductPreviewOpen, setIsProductPreviewOpen] = useState(false);
  const [clickedProductId, setClickedProductId] = useState("");

  const classes = useStyles();

  const handlePreviewVideoClick = (product) => {
    if (product.video_count > 0) {
      setClickedProductId(product.sku);
      setIsProductPreviewOpen(true);
    }
  };

  const closeProductPreview = () => {
    setIsProductPreviewOpen(false);
  };

  return (
    <div className={classes.root}>
      <p
        className={classes.info}
      >{`Showing Page ${currentPage} for ${gender.toUpperCase()} sorted by Popularity`}</p>
      {catalogData.length !== 0 ? (
        <GridList cellHeight={350} className={classes.gridList} cols={3}>
          {catalogData._embedded.product.map((product) => (
            <GridListTile key={product._embedded.images[0].thumbnail} cols={1}>
              <img
                className={classes.thumbnail}
                src={product._embedded.images[0].thumbnail}
                alt={product.name}
              />
              <GridListTileBar title={product.name} titlePosition="top" />
              <GridListTileBar
                title={`By ${product._embedded.brand.name}`}
                titlePosition="bottom"
                subtitle={
                  <span className={classes.priceTag}>
                    Price: {`$${product.markdown_price} AUD`}
                  </span>
                }
                actionIcon={
                  <IconButton
                    aria-label={`Video Preview Link for ${product.sku}`}
                    className={classes.icon}
                    onClick={() => handlePreviewVideoClick(product)}
                  >
                    {product.video_count > 0 ? (
                      <FeaturedVideoTwoToneIcon />
                    ) : null}
                  </IconButton>
                }
              />
            </GridListTile>
          ))}
        </GridList>
      ) : (
        <></>
      )}
      <ProductVideoPreview
        isOpen={isProductPreviewOpen}
        closed={closeProductPreview}
        productId={clickedProductId}
      />
    </div>
  );
}
