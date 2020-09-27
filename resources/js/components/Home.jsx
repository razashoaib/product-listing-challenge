import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom";
import Backdrop from "@material-ui/core/Backdrop";
import CircularProgress from "@material-ui/core/CircularProgress";
import axios from "axios";
import { makeStyles } from "@material-ui/core/styles";
import CssBaseline from "@material-ui/core/CssBaseline";
import Container from "@material-ui/core/Container";
import Products from "./Products";
import Filters from "./Filters";
import Constants from "../common/constants";

function Home() {
  const [catalogData, setCatalogData] = useState([]);
  const [gender, setGender] = React.useState("male");
  const [pageSize, setPageSize] = React.useState(30);
  const [pageNumber, setPageNumber] = React.useState(1);
  const [loading, setLoading] = React.useState(true);

  const getCatalogDataFromAPI = async (url) => {
    try {
      setLoading(true);
      const response = await axios.get(url);
      setCatalogData(response.data);
      setLoading(false);
    } catch (err) {
      console.log("error while making api request");
      console.log(err);
    }
  };

  useEffect(() => {
    getCatalogDataFromAPI(
      `${Constants.BASE_URL}/products?page=${pageNumber}&page_size=${pageSize}&gender=${gender}`
    );
  }, [pageNumber, pageSize, gender]);

  const handleCloseBackdrop = () => {
    setLoading(false);
  };

  const useStyles = makeStyles((theme) => ({
    root: {
      marginTop: "10px",
    },
    backdrop: {
      zIndex: theme.zIndex.drawer + 1,
      color: "#fff",
    },
  }));

  const classes = useStyles();

  return (
    <React.Fragment>
      <CssBaseline />
      <Container className={classes.root} maxWidth="md">
        <Filters
          genderChangeCallback={(g) => setGender(g)}
          pageSizeChangeCallback={(g) => setPageSize(g)}
          pageNumberChangeCallback={(g) => setPageNumber(g)}
          currentPage={pageNumber}
          lastPage={catalogData.page_count}
        />
        <Products
          gender={gender}
          currentPage={pageNumber}
          catalogData={catalogData}
        />
      </Container>
      <Backdrop className={classes.backdrop} open={loading}>
        <CircularProgress color="inherit" />
      </Backdrop>
    </React.Fragment>
  );
}

export default Home;

if (document.getElementById("root")) {
  ReactDOM.render(<Home />, document.getElementById("root"));
}
