class Edge{
  Node tail; //自身が出ている頂点
  Node head; //自身が入る頂点
  int weight; //自身の重み
  
  Edge( Node t, Node h, int w ){
    tail = t;
    head = h;
    weight = w;
    tail.outGoing.add( this ); //自身が出ている頂点の，出ていく辺の集合に，自身を加える
    head.inComing.add( this ); //自身が入る頂点の，入る辺の集合に，自身を加える
  }
  
  void update(){
    // 自身が入る頂点の暫定最短距離が，自身が入る頂点の最短距離+自身の重みよりも
    //厳密に大きい場合に，自身が入る頂点の暫定距離を更新
    if( tail.dist + weight < head.dist )
      head.dist = tail.dist + weight;
  }
  
}

class EdgeSet extends ArrayList<Edge>{
  EdgeSet(){
  }
  
  EdgeSet( String[] data, NodeSet ns ){
    for( int i = 0; i < data.length - 1; i++ ){
      int[] edgeData = int( split( data[ i + 1 ], "," ) );
      add( new Edge( ns.get( edgeData[ 0 ] ), ns.get( edgeData[ 1 ] ), edgeData[ 2 ] ) );
    }
  }
  
  void update(){
    for( Edge e : this ){
      e.update();
    }
  }
  
}
